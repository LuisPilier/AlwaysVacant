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

  putForm(form: CategoryI){
    this.api.putCategory(form).subscribe(data => {
      console.log(data);
      document.location.href = (`http://localhost:4200/createcategory`);
    })
  }

  eliminar() {
    let datos: CategoryI = this.editarForm.value;
    this.api.deleteCategory(datos).subscribe(data => {
      console.log(data);
      document.location.href = (`http://localhost:4200/createcategory`);
    })
  }

  getToken() {
    return localStorage.getItem('Token')
  }
}
