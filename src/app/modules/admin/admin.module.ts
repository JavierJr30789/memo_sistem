import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminRoutingModule } from './admin-routing.module';
import { AdminComponent } from './pages/admin/admin.component';
import { FormsModule } from '@angular/forms';
import { TableComponent } from './components/table/table.component';
;

@NgModule({
  declarations: [

    AdminComponent,
     TableComponent
  ],
  imports: [
    CommonModule,
    AdminRoutingModule,
    FormsModule,
  
  ],
  exports: [
    AdminComponent,
    TableComponent
  ]
})
export class AdminModule { }
