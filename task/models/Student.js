// import database
const db = require("../config/database");

// make Student model
class Student {
    static all() {
    // Return Promise sebagai solusi Asynchronous
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM students";
      db.query(sql, (err, results) => {
        if (err) {
          reject(err);
        } else {
          resolve(results);
        }
      });
    });
  }

    /**
  * TODO 1: Buat fungsi untuk insert data.
  * Method menerima parameter data yang akan diinsert.
  * Method mengembalikan data student yang baru diinsert.
  */
    static create(data) {
    return new Promise((resolve, reject) => {
      const { nama, nim, email, jurusan } = data;
      const sql = "INSERT INTO students (nama, nim, email, jurusan, created_at, updated_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

      db.query(sql, [nama, nim, email, jurusan], (err, results) => {
        if (err) {
          reject(err);
        } else {
          const insertedStudent = {
            id: results.insertId,nama,nim,email,jurusan,
            created_at: results.affectedRows > 0 ? new Date() : null,
            updated_at: results.affectedRows > 0 ? new Date() : null,
          };
          resolve(insertedStudent);
        }
      });
    });
  }
}
// export model
module.exports = Student;