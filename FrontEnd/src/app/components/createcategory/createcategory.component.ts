import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-createcategory',
  templateUrl: './createcategory.component.html',
  styleUrls: ['./createcategory.component.css']
})
export class CreatecategoryComponent implements OnInit {

  constructor(private http: HttpClient) { }
  conversion: [] = [];
  ngOnInit(): void {
    this.getData();
  }
  getData(){
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/categoria.php')
    .subscribe((data:any) => { 
     this.conversion=data;
     console.log( this.conversion );
    });
  }

}
