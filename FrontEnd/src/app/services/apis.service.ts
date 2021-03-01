import { Injectable } from '@angular/core';
import{LoginI} from 'src/app/models/login.interface';
import {RegisterI} from 'src/app/models/register.interface';
import{ResponseI} from 'src/app/models/response.interface';
import {CategoryI} from 'src/app/models/category.interface';
import {HttpClient, HttpHeaders} from '@angular/common/http'
import{Observable} from 'rxjs';
import {VacantesI} from 'src/app/models/vacantes.interface';

@Injectable({
  providedIn: 'root'
})
export class ApisService {

url:string = "https://en-linea.app/AlwaysVacant/BackEnd/API/";


  constructor(private http:HttpClient) { }

  loginByUser(form:LoginI):Observable<ResponseI>{
   let direccion = this.url + "auth.php";
    return this.http.post<ResponseI>(direccion,form);
  }

  postUser(form:RegisterI):Observable<ResponseI>{

    let direccion = this.url + "Usuarios/" + "usuario.php";
    return this.http.post<ResponseI>(direccion,form);

  }
  
  postCategory(form:CategoryI):Observable<ResponseI>{

    let direccion = this.url + "categoria.php" ;
    return this.http.post<ResponseI>(direccion,form);

  }
  
  putCategory(form:CategoryI):Observable<ResponseI>{
    let direccion = this.url + "categoria.php";
    return this.http.put<ResponseI>(direccion, form);
  }

  
  
  deleteCategory(form:CategoryI):Observable<ResponseI>{
    let direccion = this.url + "categoria.php";
    
    let Opciones = {
      headers: new HttpHeaders({
        'conten-type': 'application/json'
      }),
      body: form
    }

    return this.http.delete<ResponseI>(direccion, Opciones);
  }

  getUnicaCategoria(ID_Categoria: string | null):Observable<CategoryI>{
    let direccion = this.url + "categoria.php?ID_Categoria=" + ID_Categoria;
    return this.http.get<CategoryI>(direccion);
  }

  getUnicaVacante(ID_Vacante: string | null):Observable<VacantesI>{
    let direccion = this.url + "vacante.php?ID_Vacante=" + ID_Vacante;
    return this.http.get<VacantesI>(direccion);
  }
  putVacant(form:VacantesI):Observable<ResponseI>{
    let direccion = this.url + "vacante.php";
    return this.http.put<ResponseI>(direccion, form);
  }

  deleteVacant(form:VacantesI):Observable<ResponseI>{
    let direccion = this.url + "vacante.php";
    
    let Opciones = {
      headers: new HttpHeaders({
        'conten-type': 'application/json'
      }),
      body: form
    }
    return this.http.delete<ResponseI>(direccion, Opciones);
  }

}
