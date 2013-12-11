app = require('express')()
express = require 'express'
path = require 'path'
app.configure ->
  app.use express.static(path.join(__dirname, "public"))
server = require('http').createServer app
io = require('socket.io').listen server
server.listen 3000
app.get '/',(req,res)->
  res.sendfile __dirname + '/index.html'
io.sockets.on 'connection',(socket)->
  socket.emit 'news', {hello:'world'}
  socket.on 'my other event',(data)->
    console.log data
