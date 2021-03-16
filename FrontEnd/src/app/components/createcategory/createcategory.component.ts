import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ApisService } from 'src/app/services/apis.service';
import { ResponseI } from 'src/app/models/response.interface';
import { Router } from '@angular/router'
import { CategoryI } from 'src/app/models/category.interface';
@Component({
  selector: 'app-createcategory',
  templateUrl: './createcategory.component.html',
  styleUrls: ['./createcategory.component.css']
})
export class CreatecategoryComponent implements OnInit {

  nuevoForm = new FormGroup({
    Nombre: new FormControl('', Validators.required),
    Token: new FormControl('', Validators.required)
  });





  constructor(private http: HttpClient, private api: ApisService, private router: Router) { }
  conversion: [] = [];
  paginactual: number = 1;



  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    } else {
      this.getData();
      let Token = localStorage.getItem('Token');
      this.nuevoForm.patchValue({
        'Token': Token
      });

    }
  }

  getData() {
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/categoria.php')
      .subscribe((data: any) => {
        this.conversion = data;
        console.log(this.conversion);
      });
  }

  postForm(form: CategoryI) {
    this.api.postCategory(form).subscribe(data => {
      console.log(data);
      document.location.href = (`https://alwaysvacants.000webhostapp.com/createcategory`);
    })
  }

  editarcategoria(ID_Categoria: any) {
    this.router.navigate(['editcategory', ID_Categoria]);
  }
  RedirigirPorTipoUsuario(id_rol: any) {
    console.log(id_rol)
    switch (id_rol) {
      case "1":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepagejobs`);
        break;
      case "2":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepagejobs`);
        break;
      case "3":
        document.location.href = (`https://alwaysvacants.000webhostapp.com/adminpage`);
        break;
      default:
        document.location.href = (`https://alwaysvacants.000webhostapp.com/homepage`);
    }
  }
}
