import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-homepagejobs',
  templateUrl: './homepagejobs.component.html',
  styleUrls: ['./homepagejobs.component.css']
})
export class HomepagejobsComponent implements OnInit {

  constructor(private http: HttpClient) { }
  
    conversion: [] = []; 
  

  ngOnInit(): void {
  this.getData();
  }

  getData(){
    this.http.get('https://en-linea.app/AlwaysVacant/BackEnd/API/vacante.php')
    .subscribe((data:any) => { 
     this.conversion=data;
     console.log( this.conversion );
    });
  }
}
