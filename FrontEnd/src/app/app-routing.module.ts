import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HomepageComponent} from 'src/app/components/homepage/homepage.component';
import {AdminpageComponent} from 'src/app/components/adminpage/adminpage.component';
import {EditjobComponent} from 'src/app/components/editjob/editjob.component';
import {CreatecategoryComponent} from 'src/app/components/createcategory/createcategory.component';
import {NumberofjobComponent} from 'src/app/components/numberofjob/numberofjob.component';
import {HomepagejobsComponent} from 'src/app/components/homepagejobs/homepagejobs.component';
import {JobsdetailsComponent} from 'src/app/components/jobsdetails/jobsdetails.component';
import {EditvacantComponent} from 'src/app/components/editvacant/editvacant.component';
import { EditcategoryComponent } from './components/editcategory/editcategory.component';


const routes: Routes = [
{path: '', component: HomepageComponent},
{path: 'homepage', component: HomepageComponent},
{path: 'adminpage', component: AdminpageComponent},
{path: 'editjob', component: EditjobComponent},
{path: 'createcategory', component:CreatecategoryComponent},
{path: 'numberofjobs', component: NumberofjobComponent},
{path: 'homepagejobs', component: HomepagejobsComponent},
{path: 'jobsdetails', component: JobsdetailsComponent},
{path: 'editvacant/:ID_Vacante', component: EditvacantComponent},
{path: 'editcategory/:ID_Categoria', component:EditcategoryComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }

