import { Component, OnInit } from '@angular/core';
import {VacantadminI} from 'src/app/models/vacanteadmin.interface';
import {FormGroup, FormControl, Validators} from '@angular/forms';
import {ApisService} from 'src/app/services/apis.service';


@Component({
  selector: 'app-numberofjob',
  templateUrl: './numberofjob.component.html',
  styleUrls: ['./numberofjob.component.css']
})
export class NumberofjobComponent implements OnInit {

  editarForm = new FormGroup({
    Token: new FormControl(''),
    Numero_vacantes: new FormControl(''),
   })
  constructor(private api: ApisService) { }

  ngOnInit(): void {
    let Token = localStorage.getItem('Token');
    this.editarForm.patchValue({
      'Token': Token
    });
 }
 putForm(form: VacantadminI){
  this.api.putVacantAdmin(form).subscribe(data => {
    console.log(data);
    document.location.href = (`http://localhost:4200/numberofjobs`);
  })
}
  

}
