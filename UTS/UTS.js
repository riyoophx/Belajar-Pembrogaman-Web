
const form = document.getElementById('formMahasiswa');
const tabel = document.getElementById('tabelMahasiswa').getElementsByTagName('tbody')[0];
const dataMahasiswa = [
  { nama: "Rio Febrian", prodi: "TI", semester: 3, nim: "2411102441114" },
  { nama: "Ghalib", prodi: "TI", semester: 3, nim: "2411102441307" }
];

form.addEventListener('submit', (e) => {
  e.preventDefault();

  const nama = document.getElementById('nama').value;
  const nim = document.getElementById('nim').value;
  const semester = document.getElementById('semester').value;
  const prodi = document.getElementById('prodi').value;
  const email = document.getElementById('email').value;

  const newData = { nama, nim, semester, prodi, email };

  console.log("Data Mahasiswa Baru:", newData);
  dataMahasiswa.push(newData);
  updateTable();
  form.reset();
});

function updateTable() {
  tabel.innerHTML = "";
  dataMahasiswa.forEach((mhs, index) => {
    const row = tabel.insertRow();
    row.insertCell(0).innerText = index + 1;
    row.insertCell(1).innerText = mhs.nama;
    row.insertCell(2).innerHTML = `Prodi: ${mhs.prodi} <br> Semester: ${mhs.semester}`;
  });
}