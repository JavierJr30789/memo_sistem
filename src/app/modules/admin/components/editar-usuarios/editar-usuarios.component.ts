import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { UsuarioService } from 'src/app/services/usuario.service';
@Component({
  selector: 'app-editar-usuario',
  templateUrl: './editar-usuario.component.html',
  styleUrls: ['./editar-usuario.component.css']
})
export class EditarUsuarioComponent implements OnInit {
  usuario = { id: 0, nombre: '', email: '' };
  constructor(
    private route: ActivatedRoute,
    private usuarioService: UsuarioService,
    private router: Router
  ) { }
  ngOnInit(): void {
    const id = +this.route.snapshot.paramMap.get('id');
    this.usuarioService.getUsuarios().subscribe(data => {
      this.usuario = data.personas.find(u => u.id === id);
    });
  }
  updateUsuario(): void {
    this.usuarioService.updateUsuario(this.usuario.id, this.usuario).subscribe(() => {
      this.router.navigate(['/listar-usuarios']);
    });
  }
}