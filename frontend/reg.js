  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/12.6.0/firebase-app.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyBf4a3KkzZxUcv5B0AHLbeAfS6CLsA2BHU",
    authDomain: "login-36276.firebaseapp.com",
    projectId: "login-36276",
    storageBucket: "login-36276.firebasestorage.app",
    messagingSenderId: "439225686916",
    appId: "1:439225686916:web:0a5697a5efe7b262955bd1"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);


  import { getAuth, createUserWithEmailAndPassword,signInWithEmailAndPassword } 
  from "https://www.gstatic.com/firebasejs/12.6.0/firebase-auth.js";
  import {getFireStore, setDoc, doc} from "https://www.gstatic.com/firebasejs/12.6.0/firebase-firebasestorage.js"

  


  //submit button
  const submit = document.getElementById('submit');
  submit.addEventListener("click", (event)=>{
    event.preventDefault();
    
      //inputs

  const email = document.getElementById('Email').value;
  const password = document.getElementById('Password').value;

    const auth = getAuth();
    const db = getFireStore();

    createUserWithEmailAndPassword(auth, email, password).then((userCredential)=>{
        const user = userCredential;
        const userData = {
            email: email,
            password: password

        }
    })
    
  })
