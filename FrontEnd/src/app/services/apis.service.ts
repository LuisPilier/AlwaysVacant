import { Injectable } from '@angular/core';
import{LoginI} from 'src/app/models/login.interface';
import{ResponseI} from 'src/app/models/response.interface';
import {HttpClient, HttpHeaders} from '@angular/common/http'
import{Observable} from 'rxjs';

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
}
