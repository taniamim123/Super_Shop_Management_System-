function searchMedicine() {

    let input =
    document.getElementById('searchInput')
    .value.toLowerCase();

    let table =
    document.getElementById('medicineTable');

    let tr =
    table.getElementsByTagName('tr');

    for(let i = 1; i < tr.length; i++) {

        let td =
        tr[i].getElementsByTagName('td')[1];

        if(td){

            let txtValue =
            td.textContent || td.innerText;

            if(txtValue.toLowerCase()
            .indexOf(input) > -1){

                tr[i].style.display = '';

            }else{

                tr[i].style.display = 'none';
            }
        }
    }
}