// import Express dan Routing
const express = require("express");
const router = require("./routes/api.js");

// Membuat Object Express
const app = express();

// Menggunakan Middleware
app.use(express.json());
app.use(express.urlencoded());

// Menggunakan Routing (router)
app.use(router);

// Mendefinisikan Port
app.listen(3000, () => {
    console.log("Server running at http://localhost:3000");
});