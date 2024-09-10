import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminRoutingModule } from './admin-routing.module';
import { ListarUsuariosComponent } from './components/listar-usuarios/listar-usuarios.component';
import { AgregarUsuariosComponent } from './components/agregar-usuarios/agregar-usuarios.component';
import { EditarUsuariosComponent } from './components/editar-usuarios/editar-usuarios.component';
import { AdminComponent } from './pages/admin/admin.component';


@NgModule({
  declarations: [
    ListarUsuariosComponent,
    AgregarUsuariosComponent,
    EditarUsuariosComponent,
    AdminComponent
  ],
  imports: [
    CommonModule,
    AdminRoutingModule
  ]
})
export class AdminModule { }
