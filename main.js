//Selects all input field 
let is_valid = [false, false, false, false, false, false];
const my_form = document.querySelectorAll('.my_form');

my_form.forEach((input) => {
        input.addEventListener('focusout', (event) => {
            //input value
            const val = event.target.value;

            //target input by attribute
            const name = event.target.name;

            //validation start here
            switch (name) {
                //Name input field validation
                case "name":
                    //Error shows if name field empty
                    const name_error = document.getElementById("name_error");
                    if (val == "") {
                        is_valid[0] = false;
                        name_error.innerHTML = "**You must write your name here.";
                    }
                    //Erro shows if name filed greater than 20 character
                    else if (val.length > 20) {
                        is_valid[0] = false;
                        name_error.innerHTML = "**Name should be maximum 20";
                    }
                    //Erro shows if name field is number 
                    else if (!val.match(/^[A-Za-z-, ]+$/)) {
                        is_valid[0] = false;
                        name_error.innerHTML = "**No numbers & Symbols are accepted";
                    } else {
                        is_valid[0] = true;
                        name_error.innerHTML = "";
                    }
                    break;
                    //Email input field validation
                case "email":
                    //Erro shows if email field empty
                    const email_error = document.getElementById("email_error");
                    if (val == "") {
                        is_valid[1] = false;
                        email_error.innerHTML = "** Please fill the email field.";
                    }
                    //Error shows if email not contain @ symbole
                    else if (val.indexOf('@') <= 0) {
                        is_valid[1] = false;
                        email_error.innerHTML = "**Email should be standard formate";
                    }
                    //Erro shows If email field not contain two or three character after "." symbole
                    else if (val.charAt(val.length - 4) != '.' && (val.charAt(val.length - 3) != '.')) {
                        is_valid[1] = false;
                        email_error.innerHTML = "Email should contain any domain in the end. like- .com, .net, .org, .com, .bd etc.";
                    } else {
                        is_valid[1] = true;
                        document.getElementById("email_error").innerHTML = "";
                    }
                    break;
                    //Number input field validation    
                case "number":
                    //Error shows if number field not a number
                    const number_error = document.getElementById("number_error");
                    if (isNaN(val)) {
                        is_valid[2] = false;
                        number_error.innerHTML = "**Mobile must contain number.";
                    }
                    //Error shows if character greater than 11
                    else if (val.length != 11) {
                        is_valid[2] = false;
                        number_error.innerHTML = "**Number size should be 11";
                    }
                    //Number should be bangladeshi number formate
                    else if (!val.match(/(^(\+88|0088)?(01){1}[23456789]{1}(\d){8})$/)) {
                        is_valid[2] = false;
                        number_error.innerHTML = "**Number should be bangladeshi number formate.";
                    } else {
                        is_valid[2] = true;
                        number_error.innerHTML = "";
                    }
                    break;
                    //Address input field validation 
                case "address":
                    //Error shows if address field character greater than 10
                    const address_error = document.getElementById("address_error");
                    if (val.length < 10) {
                        is_valid[3] = false;
                        address_error.innerHTML = "**Address contain minimum 10 character.";
                    } else {
                        is_valid[3] = true;
                        address_error.innerHTML = "";
                    }
                    break;
                    //Password input field validation
                case "password":
                    //Error shows if password character less than 8 or greater than 15
                    const password_error = document.getElementById("password_error");
                    if (val.length < 8 || val.length >= 15) {
                        is_valid[4] = false;
                        password_error.innerHTML = "**Password minimum 8 & maximum 15 character.";
                    }
                    /**
                     * Password validation RegEx for JavaScript
                     * 
                     * Passwords must be 
                     * - At least 8 characters long, max length 15
                     * - Include at least 1 lowercase letter
                     * - 1 capital letter
                     * - 1 number
                     * - 1 special character => !@#$%^&*.><{}_+
                     *
                     */
                    else if (val.search(/[0-9]/) == -1) {
                        is_valid[4] = false;
                        password_error.innerHTML = "**Password contain minimum 1 Number character.";
                    } else if (val.search(/[a-z]/) == -1) {
                        is_valid[4] = false;
                        password_error.innerHTML = "**Password contain minimum  1 small character.";
                    } else if (val.search(/[A-Z]/) == -1) {
                        is_valid[4] = false;
                        password_error.innerHTML = "**Password contain minimum 1 Capital character.";
                    } else if (val.search(/[!\@\#\$\%\^\&\*\.\<\>\{\}\_\+\?]/) == -1) {
                        is_valid[4] = false;
                        password_error.innerHTML = "**Password contain minimum 1 special character.";
                    } else {
                        is_valid[4] = true;
                        password_error.innerHTML = "";
                    }
                    break;
                default:
                    document.getElementById("error").innerHTML = "Check again!!!";
                    break;
            }
            submitBtnDisable();
        });

    })
    //Image Validation function
function getImage() {
    let image_error = document.getElementById("image_error");
    let image = document.getElementById("image").files[0].name;
    let img = document.getElementById("image");

    if (image != '') {
        //File extntion check
        let check_img = image.toLowerCase();
        // validation of file extension using regular expression before file upload
        if (!check_img.match(/(\.jpg|\.png)$/)) { 
            // document.getElementById("image");
            image_error.innerHTML = "**Allowed file formate: jpg, png";
            is_valid[5] = false;
            return false;
        } else {
            is_valid[5] = true;
            image_error.innerHTML = "";
        }

        //File size check
        let file_size = img.files[0].size;
        console.log(file_size);

        if (file_size > 300000) // validation according to file size
        {
            image_error.innerHTML = "File size maximum 300kb";
            is_valid[5] = false;
            return false;
        } else {
            is_valid[5] = true;
            image_error.innerHTML = "";
        }
        
        submitBtnDisable();
    }
}

//Sumbit button disable untile input field coditions are fullfilled
function submitBtnDisable() {
    console.log(is_valid);
    let f = 0;
    for (let i = 0; i < is_valid.length; i++) {
        if (!is_valid[i]) {
            f++;
        }
    }
    const submit_btn = document.querySelector('#submit_btn');
    if (f == 0) {
        submit_btn.removeAttribute("disabled");
    } else {
        submit_btn.disabled = true;
    }
}

//Store input data using XMLHttpRequest method
function saveData(e) {
    e.preventDefault();

    let url = "api/create.php";
    let formData = new FormData(document.forms.myform);

    // send it out
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.send(formData);
    // window.location = "index.php";

}

function refreshData() {
    let url = "api/get_data.php";
    let formData = new FormData(document.forms.myform);

    // send it out
    let xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.send();
    // window.location = "index.php";
    xhr.onload = function(){
        if(xhr.status == 200) {
            const data = JSON.parse(xhr.response);
            console.log(data);
            drawTable(data)
        } else {
            console.log(xhr.status);
        }
    }
}

let tableData = [];
const drawTable = (data)=> {
    tableData = data;
    const t_body = document.querySelector("#table_body");
    let inner_html = '';
    
    data.map(item => {
        /* inner_html += "<tr><td>"+item.name+"</td><td>Test Column</td><td>Test Column</td><td>Test Column</td><td>Test Column</td><td>Test Column</td></tr>"; */
        console.log(item);

        const row = document.createElement("tr");
        for(let [key, value] of Object.entries(item)){
            if(key != 'id' && key != 'password') {
                const td = document.createElement("td");
                if(key == 'image') {
                    td.innerHTML =  `<img src="uploads/${value}" width="100" height="100">`;
                } else {
                    td.innerHTML = value;
                }      

                row.appendChild(td);
            }
        }

        /* console.log(item);
        const row = document.createElement("tr");
        const name = document.createElement("td");
        name.innerHTML = item.name;
        row.appendChild(name);
        
        const email = document.createElement("td");
        email.innerHTML = item.email;
        row.appendChild(email);

        const mobile = document.createElement("td");
        mobile.innerHTML = item.number;
        row.appendChild(mobile);

        const address = document.createElement("td");
        address.innerHTML = item.address;
        row.appendChild(address);

        const image = document.createElement("td");
        image.innerHTML = `<img src="uploads/${item.image}" width="100" height="100">`;
        row.appendChild(image); */

        const action = document.createElement("td");
        action.innerHTML = `<button class="btn btn-secondary" onclick="edit(${item.id})" >Update</button><button class="btn btn-danger" onclick="deleteUser(${item.id})">Delete</button>`;
        row.appendChild(action);

        // console.log(row);
        t_body.appendChild(row);
    });
    // t_body.innerHTML = inner_html;
}
refreshData();

let currentRowId = 0;
function edit(id){
    is_valid = [true, true, true, true, true, true];
    document.getElementById("update_btn").removeAttribute("disabled");
    tableData.forEach(element => {
        if(element.id == id) {
            let box_image = document.getElementById("image_box");
            console.log(element);
            currentRowId = element.id;
            document.getElementById("row_id").value = element.id;
            document.getElementById("name").value = element.name;
            document.getElementById("email").value = element.email;
            document.getElementById("number").value = element.number;
            document.getElementById("address").value = element.address;
            document.getElementById("password").value = element.password;
            // console.log(document.getElementById("image").files);
            document.getElementById("image").value = '';

            //Set image to the div with file name
            box_image.innerHTML =  `<img src="uploads/${element.image}" width="100" height="100"><br>`+ element.image;
        }
    });
    console.log(id);

}


function updateData(){

    // let url = "api/update.php";
    // let formData = new FormData(document.forms.myform);
    // // send it out
    // let xhr = new XMLHttpRequest();
    // xhr.open("PUT", url, true);
    // xhr.send();
    // const data = xhr.response;
    // console.log(data);
 
    // xhr.onload = function(){
    //     if(xhr.status == 201) {
    //         const data = JSON.parse(xhr.response);
    //         console.log(data);
    //         updateTable(data);
    //     } else {
    //         console.log(xhr.status);
    //     }
    // }
    //After Updateing Data Shows result by refresh 
    // refreshData();
}


function deleteUser(id){

    //Select id for delete data from bckend
    console.log(id);

    //After Delete Data Shows the update result 
    //refreshData();

}