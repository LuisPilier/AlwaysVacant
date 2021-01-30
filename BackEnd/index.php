<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Prubebas</title>
    <link rel="stylesheet" href="Assets/estilo.css" type="text/css">
</head>
<body>
<div  class="container">
    <h1>Api de pruebas</h1>
    <div class="divbody">
        <h3>Auth - login</h3>
        <code>
           POST  /auth
           <br>
           {
               <br>
               "usuario" :"",  -> REQUERIDO
               <br>
               "password": "" -> REQUERIDO
               <br>
            }
        
        </code>
    </div>      
    <div class="divbody">   
        <h3>Usuarios</h3>
        <code>
           GET  /usuario
           <br>
           GET  /usuario?id=$idPaciente
        </code>
        <code>
           POST  /usuario
           <br> 
           {
            <br> 
               
               <br> 
               "Nombre" : "",                  -> REQUERIDO
               <br> 
               "Apellido":"",                 -> REQUERIDO
               <br> 
               "Usuario" :"",             
               <br>  
               "Contrasena" : "",        
               <br>        
               "ID_Rol" : "",       
               <br>       
               "Correo" : "",      
               <br>                    
               <br>       
           }
        </code>
        <code>
           PUT  /usuario
           <br> 
           {
            <br> 
            <br> 
               "ID_Usuario" : "",               -> REQUERIDO
               <br> 
               "Nombre" : "",                  -> REQUERIDO
               <br> 
               "Apellido":"",                 -> REQUERIDO
               <br> 
               "Usuario" :"",             
               <br>  
               "Contrasena" : "",        
               <br>        
               "ID_Rol" : "",       
               <br>       
               "Correo" : "",      
               <br>                    
               <br>
           }
        </code>
        <code>
           DELETE  /usuario
           <br> 
           {          
               "ID_Usuario" : ""   -> REQUERIDO
               <br>
           }
        </code>
    </div>
</div>
    
</body>
</html>
