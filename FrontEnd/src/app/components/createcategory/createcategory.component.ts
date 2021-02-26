import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import{ ApisService } from 'src/app/services/apis.service';
import {ResponseI} from 'src/app/models/response.interface';
import {CategoryI} from 'src/app/models/category.interface';
@Component({
  selector: 'app-createcategory',
  templateUrl: './createcategory.component.html',
  styleUrls: ['./createcategory.component.css']
})
export class CreatecategoryComponent implements OnInit {

  nuevoForm = new FormGroup({
    Nombre : new FormControl('',Validators.required),
    Token : new FormControl('', Validators.required)
    });
    


  constructor(private http: HttpClient, private api: ApisService) { }
  conversion: [] = [];
  
  

  ngOnInit(): void {
    let Token = localStorage.getItem('Token');
    this.nuevoForm.patchValue({
     'Token' : Token
    });
    this.getData();
  }



  getData(){
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/categoria.php')
    .subscribe((data:any) => { 
     this.conversion=data;
     console.log( this.conversion );
    });
  }

  postForm(form:CategoryI){
    this.api.postCategory(form).subscribe(data =>{
      console.log(data);
    })
}

 

}
