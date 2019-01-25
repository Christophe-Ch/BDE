const bcrypt = require('bcryptjs'); // Encryption module
const express = require('express'); // Server module
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module
const request = require('request'); // Request module

const laravel = 'http://127.0.0.1:8000/';

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

// App instantiation
const app = express();
app.use(express.json());

// Auth
app.post('/api/inscription', async (req, res) => {
    // Validation schema
    let schema = {
        name: Joi.string().required(),
        email: Joi.string().email().required(),
        password: Joi.string().regex(/.*[0-9]+.*/).regex(/.*[A-Z]+.*/).required(),
        password_confirmation: Joi.string().required().valid(Joi.ref('password')),
        centre_id: Joi.number().integer().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Send request to Laravel
        request.post(
            laravel + 'api/register', // route
            { json: req.body }, // request body
            function (error, response, body) {
                res.status(response.statusCode);
                if (!error && response.statusCode == 201) { // if request succeed
                    delete body.id;
                    return res.send({
                        registered: true,
                        user: body
                    });
                }
                else {
                    return res.send({
                        registered: false,
                        message: body
                    });
                }
            }
        );
    }
    else {
        res.status(400);
        return res.send({
            registered: false,
            message: validate.error
        });
    }
});

app.post('/api/connection', (req, res) => {
    // Validation schema
    let schema = {
        email: Joi.string().email().required(),
        password: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get credentials
        let email = req.body.email;
        let password = req.body.password;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE email = ' + database.escape(email);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                // Hash and compare passwords
                bcrypt.compare(password, results[0].password, (err, result) => {
                    if (result) { // Passwords match

                        return res.send({
                            connected: true,
                            token: results[0].api_token
                        });
                    }
                    else {
                        res.status(400);
                        return res.send({
                            connected: false,
                            token: null
                        });
                    }
                });
            }
            else { // Wrong email
                res.status(400);
                return res.send({
                    connected: false,
                    message: validate.error
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            connected: 'false',
            token: null
        });
    }
});

// Profile
app.get('/api/profile', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                delete results[0].id;
                delete results[0].password;

                return res.send({
                    user: results[0]
                });
            }
            else { // Wrong token
                res.status(400);
                return res.send({
                    user: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            user: null,
            message: validate.error
        });
    }
});

app.post('/api/profile', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required(),
        last_name: Joi.string(),
        first_name: Joi.string(),
        email: Joi.string().email()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Send request to Laravel
        request.post(
            laravel + 'api/profile', // route
            { json: req.body }, // request body
            function (error, response, body) {
                res.status(response.statusCode);
                if (!error && response.statusCode == 200) { // if request succeed
                    delete body.id;
                    return res.send({
                        result: true,
                        user: body
                    });
                }
                else {
                    return res.send({
                        result: false,
                        message: body
                    });
                }
            }
        );
    }
    else {
        res.status(400);
        return res.send({
            result: false,
            message: validate.error
        });
    }
});

// Users
app.get('/api/users', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "SELECT * FROM users";

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;


                        return res.send({
                            users: results
                        });
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token
        return res.send({
            users: null,
            message: validate.error
        });
    }
});

app.get('/api/users/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required()
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "SELECT * FROM users WHERE id = " + database.escape(id);

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;

                        if (results && results.length) {

                            return res.send({
                                user: results[0]
                            });
                        }
                        else {
                            res.status(404);
                            return res.send({
                                users: null,
                                message: "User not found"
                            });
                        }
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        res.status(400);
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

app.put('/api/users/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required(),
        last_name: Joi.string(),
        first_name: Joi.string(),
        email: Joi.string().email(),
        password: Joi.string().regex(/.*[0-9]+.*/).regex(/.*[A-Z]+.*/),
        password_confirmation: Joi.string().valid(Joi.ref('password')),
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    request.put(
                        laravel + 'api/users/' + id, // route
                        { json: req.body }, // request body
                        function (error, response, body) {
                            res.status(response.statusCode);
                            if (!error && response.statusCode == 200) { // if request succeed
                                delete body.id;
                                return res.send({
                                    result: true,
                                    user: body
                                });
                            }
                            else {
                                return res.send({
                                    result: false,
                                    message: body
                                });
                            }
                        }
                    );
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        res.status(400);
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

app.delete('/api/users/:id', (req, res) => {
    // Validation schemas
    let bodySchema = {
        token: Joi.string().required()
    };

    let paramsSchema = {
        id: Joi.number().integer().required()
    };

    let validateBody = Joi.validate(req.body, bodySchema);
    let validateParams = Joi.validate(req.params, paramsSchema);

    if (!validateBody.error && !validateParams.error) {
        // Get token
        let api_token = req.body.token;
        let id = req.params.id;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                if (results[0].statut_id == 2) { // If user has BDE status
                    sql = "DELETE FROM users WHERE id = " + database.escape(id);

                    database.query(sql, (error, results, fields) => { // Get all users
                        if (error) throw error;


                        return res.send({
                            message: "User deleted"
                        });
                    });
                }
                else {
                    res.status(400);
                    return res.send({
                        users: null,
                        message: "Not authorized"
                    });
                }
            }
            else {
                res.status(400);
                return res.send({
                    users: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else { // Wrong token or id
        return res.send({
            users: null,
            bodyMessage: validateBody.error,
            paramsMessage: validateParams.error
        });
    }
});

// Shop
app.get('/api/articles', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                sql = 'SELECT * FROM articles WHERE centre_id = ' + results[0].centre_id;

                database.query(sql, (error, results, fields) => {
                    if (error) throw error;

                    res.status(200);
                    return res.send({
                        articles: results
                    });
                });
            }
            else { // Wrong token
                res.status(400);
                return res.send({
                    user: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            user: null,
            message: validate.error
        });
    }
});

// Events
app.get('/api/events', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                sql = 'SELECT * FROM manifestations WHERE centre_id = ' + results[0].centre_id;

                database.query(sql, (error, results, fields) => {
                    if (error) throw error;

                    res.status(200);
                    return res.send({
                        articles: results
                    });
                });
            }
            else { // Wrong token
                res.status(400);
                return res.send({
                    user: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            user: null,
            message: validate.error
        });
    }
});

// Ideas
app.get('/api/ideas', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.body, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.body.token;

        // Prepare sql statement
        let sql = 'SELECT * FROM users WHERE api_token = ' + database.escape(api_token);

        // Query
        database.query(sql, (error, results, fields) => {
            if (error) throw error;

            if (results && results.length) {
                sql = 'SELECT * FROM idees WHERE centre_id = ' + results[0].centre_id;

                database.query(sql, (error, results, fields) => {
                    if (error) throw error;

                    res.status(200);
                    return res.send({
                        articles: results
                    });
                });
            }
            else { // Wrong token
                res.status(400);
                return res.send({
                    user: null,
                    message: "Token doesn't exist"
                });
            }
        });
    }
    else {
        res.status(400);
        return res.send({
            user: null,
            message: validate.error
        });
    }
});

// Start server
app.listen(3000, 'localhost', () => {
    console.log('API listening on port 3000')
})

