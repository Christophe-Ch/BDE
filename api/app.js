const express = require('express')
const app = express()

app.get('/api/', function (req, res) {
  res.send({hello : 'World!'});
})

app.listen(3000, function () {
  console.log('Example app listening on port 3000!')
})

