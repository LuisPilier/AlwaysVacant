import { Injectable } from '@angular/core';
import{LoginI} from 'src/app/models/login.interface';
import {RegisterI} from 'src/app/models/register.interface';
import{ResponseI} from 'src/app/models/response.interface';
import {CategoryI} from 'src/app/models/category.interface';
import {HttpClient, HttpHeaders} from '@angular/common/http'
import{Observable} from 'rxjs';
import {DataVacantesI} from 'src/app/models/datavacantes.interface';

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
  


}
