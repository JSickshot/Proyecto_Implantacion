//programacion para que jale el usuario

const users = [
    //agrega a los usuarios que necesites en este caso, se especifica quienes son
      { username: "user", password: "123" },
    ];
    
    //dejalo asi
    
    function login() {
      var username = document.getElementById("username").value;
      var password = document.getElementById("password").value;
    
      
      const user = users.find((user) => user.username === username && user.password === password);
    
      if (user) {
        window.location.href = "principal.html";
      } else {
  
        alert("escriba bien");
      }
    }