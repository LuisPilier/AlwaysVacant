import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { ApisService } from 'src/app/services/apis.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { CategoryI } from 'src/app/models/category.interface';
@Component({
  selector: 'app-editcategory',
  templateUrl: './editcategory.component.html',
  styleUrls: ['./editcategory.component.css']
})
export class EditcategoryComponent implements OnInit {

  constructor(private activerouter: ActivatedRoute, private router: Router, private api: ApisService) { }
  //@ts-ignore
  datosCategoria!: CategoryI;

  editarForm = new FormGroup({
    Token: new FormControl(''),
    Nombre: new FormControl(''),
    ID_Categoria: new FormControl('')
  })
  ngOnInit(): void {
    if (localStorage.getItem('ID_Rol') != '3') {
      this.RedirigirPorTipoUsuario(localStorage.getItem('ID_Rol'));
    } else {
      let ID_Categoria = this.activerouter.snapshot.paramMap.get('ID_Categoria');
      let Token = this.getToken();
      this.api.getUnicaCategoria(ID_Categoria).subscribe(data => {
        //@ts-ignore
        this.datosCategoria = data[0];
        this.editarForm.setValue({
          'Token': Token,
          'Nombre': this.datosCategoria.Nombre,
          'ID_Categoria': this.datosCategoria.ID_Categoria
        });
        console.log(this.editarForm.value);
      })
    }
  }

  putForm(form: CategoryI) {
    this.api.putCategory(form).subscribe(data => {
      console.log(data);
      document.location.href = (`https://alwaysvacant.netlify.app/createcategory`);
    })
  }

  eliminar() {
    let datos: CategoryI = this.editarForm.value;
    this.api.deleteCategory(datos).subscribe(data => {
      console.log(data);
      document.location.href = (`https://alwaysvacant.netlify.app/createcategory`);
    })
  }

  getToken() {
    return localStorage.getItem('Token')
  }
  RedirigirPorTipoUsuario(id_rol: any) {
    console.log(id_rol)
    switch (id_rol) {
      case "1":
        document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
        break;
      case "2":
        document.location.href = (`https://alwaysvacant.netlify.app/homepagejobs`);
        break;
      case "3":
        document.location.href = (`https://alwaysvacant.netlify.app/adminpage`);
        break;
      default:
        document.location.href = (`https://alwaysvacant.netlify.app/homepage`);
    }
  }
}
