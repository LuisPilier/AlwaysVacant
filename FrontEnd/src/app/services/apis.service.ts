import {HttpClient, HttpHeaders} from '@angular/common/http'
import { Injectable } from '@angular/core';

import{LoginI} from 'src/app/models/login.interface';
import {RegisterI} from 'src/app/models/register.interface';
import{ResponseI} from 'src/app/models/response.interface';
import {CategoryI} from 'src/app/models/category.interface';
import{Observable} from 'rxjs';
import {VacantesI} from 'src/app/models/vacantes.interface';
import{VacantadminI} from 'src/app/models/vacanteadmin.interface';
import { CitiesI } from '../models/cities.interface';

@Injectable({
  providedIn: 'root'
})

export class ApisService {

  url:string = "http://always-vacant.herokuapp.com/api/";

  constructor(private http:HttpClient) { }

  loginByUser(form:LoginI):Observable<ResponseI>{

    let direccion = this.url + "auth";
    return this.http.post<ResponseI>(direccion,form);

  }

  postUser(form:RegisterI):Observable<ResponseI>{

    let direccion = this.url + "usuarios";
    return this.http.post<ResponseI>(direccion,form);

  }

  postCategory(form:CategoryI):Observable<ResponseI>{

    let direccion = this.url + "categorias" ;
    return this.http.post<ResponseI>(direccion,form);

  }

  postJob(form:VacantesI):Observable<ResponseI>{

    let direccion = this.url + "vacantes";
    return this.http.post<ResponseI>(direccion,form);

  }

  putCategory(form:CategoryI):Observable<ResponseI>{

    let direccion = this.url + "categorias";
    return this.http.put<ResponseI>(direccion, form);

  }

  deleteCategory(form:CategoryI):Observable<ResponseI>{

    let direccion = this.url + "categorias";

    let Opciones = {
      headers: new HttpHeaders({
        'conten-type': 'application/json'
      }),
      body: form
    }

    return this.http.delete<ResponseI>(direccion, Opciones);
  }

  getCiudades(Codigo_Pais: string | null):Observable<CitiesI>{

    let direccion = this.url + "Localidades/ciudades.php?Codigo_pais=" + Codigo_Pais;
    return this.http.get<CitiesI>(direccion);

  }

  getUnicaCategoria(ID_Categoria: string | null):Observable<CategoryI>{

    let direccion = this.url + "categorias?ID_Categoria=" + ID_Categoria;
    return this.http.get<CategoryI>(direccion);

  }

  getUnicoJob(ID_Vacante: string | null):Observable<VacantesI>{

    let direccion = this.url + "vacantes?ID_Vacante=" + ID_Vacante;
    return this.http.get<VacantesI>(direccion);

  }

  getUnicaVacante(ID_Vacante: string | null):Observable<VacantesI>{

    let direccion = this.url + "vacantes?ID_Vacante=" + ID_Vacante;
    return this.http.get<VacantesI>(direccion);

  }

  putVacant(form:VacantesI):Observable<ResponseI>{

    let direccion = this.url + "vacantes";
    return this.http.put<ResponseI>(direccion, form);

  }

  deleteVacant(form:VacantesI):Observable<ResponseI>{

    let direccion = this.url + "vacantes";

    let Opciones = {
      headers: new HttpHeaders({
        'conten-type': 'application/json'
      }),
      body: form
    }
    return this.http.delete<ResponseI>(direccion, Opciones);

  }

  putVacantAdmin(form:VacantadminI):Observable<ResponseI>{

    let direccion = this.url + "Usuarios/" + "usuario_admin.php";
    return this.http.put<ResponseI>(direccion, form);

  }

}
