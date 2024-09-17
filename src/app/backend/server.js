const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');

const app = express();
app.use(cors());

const connection = mysql.createConnection({
host: "10.10.0.62",
user: "desarrollo",
password: "fisca1234",
database: "GestionMemo",
});

app.get('/test-connection', (req, res)=> {
connection.connect((err) => {

if (err) {
res.status(500).send("Error al conectar con la base de datos");
} else {
res.status(200).send("Conexión exitosa a la base de datos");
}
});
});

const PORT = 3000;
app.listen(PORT, () => {
console.log(`Servidor corriendo en http://localhost:${PORT}`);
});