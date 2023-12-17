const serverData = [
];

function displayData() {
    const dataTable = document.getElementById("dataTable");
    dataTable.innerHTML = "";

    const headerRow = dataTable.insertRow(0);
    for (let key in serverData[0]) {
        const headerCell = headerRow.insertCell();
        headerCell.textContent = key.charAt(0).toUpperCase() + key.slice(1);
    }

    serverData.forEach((data, index) => {
        const row = dataTable.insertRow(index + 1);
        for (let key in data) {
            const cell = row.insertCell();
            cell.textContent = data[key];
        }
    });
}

function submitForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const age = document.getElementById("age").value;
    const gender = document.querySelector('input[name="gender"]:checked').value;
    const subscribe = document.getElementById("subscribe").checked;

    if (name === "" || email === "" || age === "") {
        alert("Please fill in all the fields.");
        return;
    }

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return;
}
    
    serverData.push({ name, email, age, gender, subscribe });
    displayData();

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "process.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.body.innerHTML += xhr.responseText;
        }
    };

    const formData = `name=${name}&email=${email}&age=${age}&gender=${gender}&subscribe=${subscribe}`;
    xhr.send(formData);
}

const userData = {
    id: 1,
    username: 'user123',
    email: 'user@example.com'
};

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const cname = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookies = decodedCookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(cname) === 0) {
            return cookie.substring(cname.length, cookie.length);
        }
    }
    return "";
}

function deleteCookie(name) {
    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function saveToLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function getFromLocalStorage(key) {
    const value = localStorage.getItem(key);
    return value ? JSON.parse(value) : null;
}

function removeFromLocalStorage(key) {
    localStorage.removeItem(key);
}

setCookie('user', JSON.stringify(userData), 7);

const retrievedUser = JSON.parse(getCookie('user'));
console.log('Retrieved user from cookie:', retrievedUser);

saveToLocalStorage('user', userData);

const retrievedUserLocal = getFromLocalStorage('user');
console.log('Retrieved user from local storage:', retrievedUserLocal);

deleteCookie('user');

removeFromLocalStorage('user');

displayData();
