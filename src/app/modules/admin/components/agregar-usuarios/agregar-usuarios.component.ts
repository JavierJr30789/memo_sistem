import { Component } from '@angular/core';
import { UsuarioService } from 'src/app/services/usuario.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-agregar-usuario',
  templateUrl: './agregar-usuario.component.html',
  styleUrls: ['./agregar-usuario.component.css']
})
export class AgregarUsuarioComponent {
  usuario = { nombre: '', email: '' };
  constructor(private usuarioService: UsuarioService, private router: Router) { }
  addUsuario(): void {
    this.usuarioService.addUsuario(this.usuario).subscribe(() => {
      this.router.navigate(['/listar-usuarios']);
    });
  }
}