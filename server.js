// Membaca data dari serial port
// pada Arduino
// source : 
// https://www.codeproject.com/Articles/389676/Arduino-and-the-Web-using-NodeJS-and-SerialPort
// modified by yopi ardinal 1 Maret 2018

var serialport = require("serialport");
var SerialPort = serialport.SerialPort;
var portName = 'COM3';
 
var sp = new serialport(portName,{
baudRate: 9600
});

const Readline = serialport.parsers.Readline;
const parser = new Readline;
sp.pipe(parser);

parser.on('data', function (data) { // call back when data is received
 
		console.log(data);
        io.sockets.emit('message', data);
	
});


var io = require('socket.io').listen(4000); // server listens for socket.io communication at port 4000

io.sockets.on('connection', function (socket) {
	// If socket.io receives message from the client browser then 
    // this call back will be executed.
    socket.on('message', function (msg) {
    	console.log(msg);
    });
    // If a web browser disconnects from Socket.IO then this callback is called.
    socket.on('disconnect', function () {
    	console.log('disconnected');
    });
});






