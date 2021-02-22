import { Injectable } from '@angular/core';
import{LoginI} from 'src/app/models/login.interface';
import{ResponseI} from 'src/app/models/response.interface';
import {HttpClient, HttpHeaders} from '@angular/common/http'
import{Observable} from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApisService {

url:string = "/AlwaysVacant/BackEnd/API/Usuarios/";

  constructor(private http:HttpClient) { }

  loginByUser(form:LoginI):Observable<ResponseI>{
   let direccion = this.url + "auth";
    return this.http.post<ResponseI>(direccion,form);
  }
}
