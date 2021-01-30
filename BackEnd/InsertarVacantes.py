#Developed 
#Joao Navarro 
#Copyrights 

def Insert(): 
 import MySQLdb

 bd = MySQLdb.connect("freedb.tech","freedbtech_rootJ","Masdacx9","freedbtech_Always_Vacant" )
 Compañia    = input("Compañia: ")
 logo        = input("Logo    : ")
 Url = input("URL     :")
 Posicion        = input("Posicion    : ")
 Descripcion     = input("Descripcion   : ")
 Ubicacion    = input("Ubicacion   : ")
 Id_Categoria     = input("Id de la categoria  : ")
 ID_Tipo_Vacante     = input("id de la vacante   : ")
 Email     = input("Email   : ")

 cursor = bd.cursor()

 sql = "INSERT INTO Vacante (Compania, Logo, URL,Posicion, Descripcion,Ubicacion,ID_Categoria,ID_Tipo_Vacante,Email) VALUES ('"+Compañia+"', '"+logo+"', '"+Url+"', '"+Posicion+"', '"+Descripcion+"', '"+Ubicacion+"', "+Id_Categoria+", "+ID_Tipo_Vacante+", '"+Email+"')"
 try:
   # Ejecutamos el comando
   cursor.execute(sql)
   # Efectuamos los cambios en la base de datos
   bd.commit()
 except :
   # Si se genero algun error revertimos la operacion
   bd.rollback()

 print ("Registro Grabado  Correctamente")

 sql = "SELECT * FROM Vacante "
 cursor.execute(sql)
 registro = cursor.fetchone()
 while (registro != None):
    print (registro)
    registro = cursor.fetchone()

Insert();

