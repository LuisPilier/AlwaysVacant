import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import{ ApisService } from 'src/app/services/apis.service';
import {LoginI} from 'src/app/models/login.interface';
@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css'],
  providers: [ApisService]
})
export class HomepageComponent implements OnInit {

loginForm = new FormGroup({
Usuario : new FormControl('',Validators.required),
Pass : new FormControl('',Validators.required),
});
  

  constructor(private api: ApisService) { }

  ngOnInit(): void {
  }

  onlogin(form:LoginI){
    this.api.loginByUser(form).subscribe(data =>{
      console.log(data);
    })
  }
 

}
