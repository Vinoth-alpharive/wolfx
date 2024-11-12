try {
	var TronWeb = require('tronweb')
	var HttpProvider = TronWeb.providers.HttpProvider;
	var fullNode = new HttpProvider("https://api.trongrid.io");
	var solidityNode = new HttpProvider("https://api.trongrid.io");
	var eventServer = new HttpProvider("https://api.trongrid.io");
	var privateKey = "3481E79956D4BD95F358AC96D151C976392FC4E3FC132F78A847906DE588C145";
	var tronWeb = new TronWeb(fullNode,solidityNode,eventServer,privateKey);
	tronWeb.setHeader({"TRON-PRO-API-KEY": '774ce5a1-439c-428d-9a92-effab265c3b9'});

	//get address here
	tronWeb.createAccount().then(function (result) {
		var obj = {
			"address" : result.address.base58,
			"privateKey" : result.privateKey,
			"hexAddress" : result.address.hex
		};
		console.log(JSON.stringify(obj));
	});
}
catch(err) {
	console.log(err);
}