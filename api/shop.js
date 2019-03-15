// Modules
const express = require('express');
const router = express.Router();
const mysql = require('mysql'); // MySQL module
const Joi = require('joi'); // Input validation module

// Database connection
const database = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'root',
    database: "bde"
});

router.get('/', (req, res) => {
    // Validation schema
    let schema = {
        token: Joi.string().required()
    };

    let validate = Joi.validate(req.query, schema);

    if (!validate.error) {
        // Get token
        let api_token = req.query.token;

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

module.exports = router;