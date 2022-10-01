
/**
 * VARIABLES
 */
var inputs = document.getElementsByTagName("input");
var selects = document.getElementsByTagName("select");

// self invoke function
(function () {
    invokeAstrisk();
})();

/**
 * showPass function v1.0
 * input is the icon to show password
 */
function showPass(input) {
    let passwordInput = input.previousElementSibling;
    if (input.classList.contains("bi-eye-slash")) {
        input.classList.replace("bi-eye-slash", "bi-eye");
        passwordInput.setAttribute("type", "text")
    } else {
        input.classList.replace("bi-eye", "bi-eye-slash");
        passwordInput.setAttribute("type", "password")
    }
}

/**
 * addAstrisk function
 * this function is used to add astrisk mark on required inputs
 */
function addAstrisk(inputs) {
    // loop on inputs
    for (const input of inputs) {
        // add astrisk on required field
        if (input.hasAttribute("required") || input.getAttribute("required") == "required") {
            if (!input.hasAttribute("data-no-astrisk")) {
                let astrisk = document.createElement("span");
                astrisk.classList.add("text-danger", "fw-bold", "astrisk");
                astrisk.textContent = "*";
                // append astrisk
                input.parentElement.appendChild(astrisk);
            }
        } else if (input.nextElementSibling != null && input.nextElementSibling.classList.contains("astrisk")) {
            input.parentElement.removeChild(input.nextElementSibling);
        }
    }
}
/**
 * invokeAstrisk function
 */
function invokeAstrisk() {
    // check if inputs not null
    if (inputs != null) {
        addAstrisk(inputs);
    }

    // check if selects not null
    if (selects != null) {
        addAstrisk(selects);
    }
}

/**
 * function to put data into the modal
 */
function putDataUnitModal(btn) {
    let target = btn.dataset.target;
    let unitId = btn.dataset.unitId;
    let nameAr = btn.dataset.nameAr;
    let nameEn = btn.dataset.nameEn;


    if (target == "edit") {
        // check if target is edit
        // put unit id in hidden input to update or delete it
        document.querySelector("#editUnitModal input#unit-id").value = unitId;
        document.querySelector("#editUnitModal input#unit-name-ar").value = nameAr;
        document.querySelector("#editUnitModal input#unit-name-en").value = nameEn;
        document.querySelector("#editUnitModal span#unit-name").textContent = nameAr;
    } else if (target == "delete") {
        // check if target is delete
        document.querySelector("#deleteUnitModal input#unit-id").value = unitId;
        document.querySelector("#deleteUnitModal span#unit-name").textContent = nameAr;
    }
}

/**
 * uploadSoldierImage function 
 */
function uploadSoldierImage(btn) {
    // soldier image element
    let soldierImgEl = btn.parentElement.previousElementSibling;
    // get image path
    let imgPath = URL.createObjectURL(btn.files[0]);
    // upload image
    soldierImgEl.setAttribute("src", imgPath);
}

/**
 * showChild if the the soldier is merrage show number of child input
 */
function showChild(input) {
    // number of child input
    let childInput = document.getElementById("number-child");
    // check the value of status
    if (input.value == 0) {
        childInput.setAttribute("disabled", "disabled");
        childInput.removeAttribute("required");
    } else {
        childInput.removeAttribute("disabled");
        childInput.setAttribute("required", "required");
    }
    // check the astrisks
    invokeAstrisk();
}

/**
 * When update specilization
 * we need to put the specialization id into an hidden input to send it with the request  
 */
function putSpecId(select) {
    let specIdInput = select.previousElementSibling;
    specIdInput.value = select.value;
}


function checkNewSpecValue(btn) {
    // form
    let target = btn.dataset.target.toLowerCase();
    let form = document.getElementById("updateSpecializationForm");
    let spec_id = document.getElementById("specialization-id");
    let new_spec = document.getElementById("specialization-new");
    let idAlert = document.getElementById("specIdMsg");
    let specAlert = document.getElementById("specMsg");

    // check value of specialization id
    if (spec_id.value === "") {
        idAlert.classList.remove("d-none")
    } else {
        idAlert.classList.add("d-none")
    }

    // check target
    if (target === "update") {
        // check new value of the specialization name
        if (new_spec.value === "") {
            specAlert.classList.remove("d-none")
        } else {
            specAlert.classList.add("d-none")
        }
        // check value of specialization id && check new value of the specialization name
        if (spec_id.value !== "" && new_spec.value !== "") {
            // change form action
            form.action = "soldiers.php?do=updateSpecialization"
            form.submit();  // submit form
        }
    } else {
        // check value of specialization id 
        if (spec_id.value !== "") {
            // change form action
            form.action = "soldiers.php?do=deleteSpecialization"
            form.submit();  // submit form
        }
    }

    console.log(target)
}


// when click any key in search input
function tableFiltration(input, body) {
    // get table body
    let tbl_body = document.getElementById(body);
    // get search value
    let searchText = input.value.toLowerCase();
    // loop in table
    for (let i = 0; i < tbl_body.children.length; i++) {
        td1 = tbl_body.children[i].children[2];
        td2 = tbl_body.children[i].children[3];
        // check the td of ip or td of name
        if (td1 || td2) {
            if (td1.textContent.toLowerCase().indexOf(searchText) > -1 || td2.textContent.toLowerCase().indexOf(searchText) > -1) {
                tbl_body.children[i].style.display = "";
            } else {
                tbl_body.children[i].style.display = "none";
            }
        }
    }
}

/**
 * getDateNow function v1
 * This function is used to get the date for now
 */
function getDateNow() {
    // dayes array
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    // months array
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    // date object to get full date and time details
    let dateObj = new Date();
    let date = `${days[dateObj.getDay()]}, ${months[dateObj.getMonth()]
        } ${dateObj.getDate()}, ${dateObj.getFullYear()}`;
    // return the date
    return date;
}


/**
 * getTimeNow function v1
 * This function is used to get the date for now
 */
function getTimeNow() {
    // date object to get full date and time details
    let dateObj = new Date();
    // prepare the time
    let time = "";
    // check the time mode
    if (dateObj.getHours() < 12) {
        time = `${dateObj.getHours()}:${dateObj.getMinutes()} Am`;
    } else {
        time = `${dateObj.getHours() - 12}:${dateObj.getMinutes()} pm`;
    }
    // return the date
    return time;
}

/**
 *
 */
function getBackup(id) {
    // get request to get backup of data
    $.get(`requests.php?do=backup&id=${id}`, (data) => {
        if (data == 1) {
            // get date and time
            let date = getDateNow();
            let time = getTimeNow();
            // prepare the message
            let message = `Backup successed on ${date} at ${time} ..`;
            message += "\nENG HASSIB GREATING YOU AND SAYS `HAVE A NICE DAY` ..\n";
            // show message
            alert(message);
        } else {
            console.log("cannot take a backup");
        }
    });
}