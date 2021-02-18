import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HomepageComponent} from 'src/app/components/homepage/homepage.component';
import {AdminpageComponent} from 'src/app/components/adminpage/adminpage.component';
import {PagepostjobComponent} from 'src/app/components/pagepostjob/pagepostjob.component';
import {EditjobComponent} from 'src/app/components/editjob/editjob.component';
const routes: Routes = [
{path: '', component: HomepageComponent},
{path: 'homepage', component: HomepageComponent},
{path: 'adminpage', component: AdminpageComponent},
{path: 'postajob', component: PagepostjobComponent},
{path: 'editjob', component: EditjobComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
