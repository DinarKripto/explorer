const Web3 = require("web3");
const mysql = require("mysql");
const config = require("./config.json");
const axios = require('axios');
const InputDataDecoder = require('ethereum-input-data-decoder');
const decoder = new InputDataDecoder(config.CONTRACT_ABI);

const web3 = new Web3(new Web3.providers.HttpProvider(config.WEB3_END_POINT));
const contract = new web3.eth.Contract(config.TOKEN_ABI, config.TOKEN_ADDRESS);

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: config.DB_NAME
});

connection.connect(err => {
  if (err) {
    throw err;
  } else {
    console.log("Connected!");
    seedDatabase();
    seedContractTransactions();
  }
});

const seedContractTransactions = async () => {
  try {
    connection.query(
      "SELECT max(blockNumber) as blockNumber FROM contract_transactions",
      function (err, rows) {
        if (err) throw err;
        updateTransactionRecords(rows[0]);
      }
    );
  } catch (e) {
    if (e) console.warn("Warning! Service not feeding database. ", e);
  }
};



const updateTransactionRecords = async data => {
  console.log(data.blockNumber);
  var max = 0;

  if(data != null){
    max = data.blockNumber + 1;
  }
  var url = 'http://api.etherscan.io/api?module=account&action=txlist&address='+ config.TOKEN_ADDRESS +'&startblock='+ max +'&endblock=99999999&sort=asc&apikey=1HUI6UTTVE64IMQYPH85UCWA12JXXM4CEQ';
  
  axios.get(url)
  .then(response => {
    response.data.result.forEach(async row => {
      // console.log(row.input);

      let now = new Date().toISOString().slice(0, 19).replace('T', ' ');
      const decode = decoder.decodeData(row.input);

      var sql = 'INSERT INTO `contract_transactions`(`blockHash`, `blockNumber`, `confirmations`, `contractAddress`, `cumulativeGasUsed`, `from`, `gas`, `gasPrice`, `gasUsed`, `hash`, `input`, `isError`, `nonce`, `timeStamp`, `to`, `transactionIndex`, `txreceipt_status`, `value`,`method`,`decodeInput`, `created_at`, `updated_at`) VALUES'; 
      sql = sql + '(\'' + row.blockHash;
      sql = sql + '\',\'' + row.blockNumber;
      sql = sql + '\',\'' + row.confirmations;
      sql = sql + '\',\'' + row.contractAddress;
      sql = sql + '\',\'' + row.cumulativeGasUsed;
      sql = sql + '\',\'' + row.from;
      sql = sql + '\',\'' + row.gas;
      sql = sql + '\',\'' + row.gasPrice;
      sql = sql + '\',\'' + row.gasUsed;
      sql = sql + '\',\'' + row.hash;
      sql = sql + '\',\'' + row.input;
      sql = sql + '\',\'' + row.isError;
      sql = sql + '\',\'' + row.nonce;
      sql = sql + '\',\'' + row.timeStamp;
      sql = sql + '\',\'' + row.to;
      sql = sql + '\',\'' + row.transactionIndex;
      sql = sql + '\',\'' + row.txreceipt_status;
      sql = sql + '\',\'' + row.value;
      sql = sql + '\',\'' + decode.method;
      sql = sql + '\',\'' + JSON.stringify(decode);
      
      sql = sql + '\',\'' + now;
      sql = sql + '\',\'' + now;
      sql = sql + '\')';
      // console.log(sql);
      connection.query(sql, function (err, result) {
        if (!err){
          // console.log("New record inserted with hash " + row.hash);
        } 
        else {
          console.log("Some error is occured " + err);
        }
      });
    });
    
  })
  .catch(error => {
    console.log(error);
  });  
  
  setTimeout(() => {
    seedContractTransactions();
  // }, 1000000000);
  }, 60000);
  console.log("Finish");
}

const seedDatabase = async () => {
  console.log(
    `Token watcher for address ${config.TOKEN_ADDRESS} is searching events.`
  );

  try {
    connection.query(
      "SELECT * FROM ethblock ORDER BY blocknumber DESC LIMIT 1",
      function (err, rows) {
        if (err) throw err;
        updateRecords(rows[0]);
      }
    );
  } catch (e) {
    if (e) console.warn("Warning! Service not feeding database. ", e);
  }

  setTimeout(() => {
    seedDatabase();
  }, 60000);
};

const updateRecords = async data => {
  var blockNumber = (data !== null? typeof data === "undefined"? 0 : data.BlockNumber + 1 : 0);
  console.log ("blockNumber is " + blockNumber);
  var latest = await web3.eth.getBlockNumber();
  console.log ("latest blockNumber is " + latest);
 
  contract.getPastEvents(
    'allEvents',
    {
      fromBlock:blockNumber,
      toBlock: latest
    },
    async (error, event) => {
      if (error) return;
      if (Array.isArray(event)) {
        console.log("total events are " + event.length);
        if (event.length === 0) return;
        
        try {
          event.forEach(async eventDetail => {
            console.log(eventDetail.blockNumber);
            let txDetailsReceipt = await web3.eth.getTransactionReceipt(
              eventDetail.transactionHash
            );
            let txDetails = await web3.eth.getTransaction(
              eventDetail.transactionHash
            );
            let blockDetails = await web3.eth.getBlock(eventDetail.blockNumber);
            const decode = decoder.decodeData(txDetails.input);
            // console.log(decode);
            var sql = "";
            sql = `INSERT INTO ethblock (BlockNumber, BLOCKHASH, TXHASH, TXNSTATUS, Nounce, 
              TRANSACTIONINDEX, FROMADDRESS, TOADDRESS, VALUE, TIME, GASPRICE, GAS, INPUT, 
              FromToken, ToToken, TOKENRECEIVERADDRESS, NUMBEROFTOKENS, METHOD, DECODEINPUT) VALUES 
              ( '${eventDetail.blockNumber}', '${eventDetail.blockHash}', '${eventDetail.transactionHash}', 
              '${txDetailsReceipt.status}', '${txDetails.nonce}', '${eventDetail.transactionIndex}', 
              '${txDetails.from}', '${txDetails.to}', '${txDetails.value}', '${blockDetails.timestamp}', 
              '${txDetails.gasPrice}', '${txDetails.gas}', '${txDetails.input}', 
              '${eventDetail["returnValues"].from}', '${eventDetail["returnValues"].to}', 
              '${eventDetail["returnValues"].to}', '${eventDetail["returnValues"].value}','${decode.method}','${JSON.stringify(decode)}')`;
              //console.log(eventDetail);
              connection.query(sql, function (err, result) {
                if (!err){
                   console.log("New record inserted");
                } 
                else {
                   console.log("Error! Record is not fetching " + err);
                }
              });


          });
        } catch (e) {
          if (e) console.warn("Error! Records not fetching. ", e);
        }
      }
    }
  );
};
