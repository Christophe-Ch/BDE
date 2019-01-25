// Modules
const express = require('express');
const router = express.Router();
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module
const request = require('request'); // Request module

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

const laravel = 'http://127.0.0.1:8000/';

router.get('/profile', (req, res) => {
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

router.put('/profile', (req, res) => {
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
        request.put(
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

module.exports = router;