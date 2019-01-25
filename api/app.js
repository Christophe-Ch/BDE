// Modules
const express = require('express'); // Server module

// App instantiation
const app = express();
app.use(express.json());

// Routers
const auth = require('./auth.js');
const profile = require('./profile.js');
const users = require('./users.js');
const shop = require('./shop.js');
const events = require('./events.js');
const ideas = require('./ideas.js');

app.use('/api/', auth);
app.use('/api/', profile);
app.use('/api/users/', users);
app.use('/api/articles/', shop);
app.use('/api/events/', events);
app.use('/api/ideas/', ideas);

// Start server
app.listen(3000, 'localhost', () => {
    console.log('API listening on port 3000')
})

