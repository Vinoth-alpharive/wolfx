var http = require('http'),
qs = require('querystring');
var Web3 = require("web3");

var web3 = new Web3('http://217.160.53.128:8545');
try {
	var account = web3.eth.accounts.create();
	var privateKey = account.privateKey;
    var addr = account.address;
	var obj = {
				'address' : addr.toString(),
				'privateKey' : privateKey.toString()
			};
}
catch(err) {
	console.log(err);
}
console.log(JSON.stringify(obj));