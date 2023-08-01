### BACK END CLINICARE

## Funcionalidades desenvolvidas
- [x] Basic Auth
- [x] Modularização de rotas por entidade
- [ ] Roles & permissões

## End points desenvolvidos
- [x] POST /login
### Usuários
- [x] GET /users
- [x] GET /users/workspace/id/@id
- [x] GET /user
- [x] GET /user/id/@user_id
- [x] GET /user/email/@user_email
- [x] POST /user
- [x] PUT /user/id/@user_id
- [x] DELETE /user/id/@user_id
### Permissões dos usuários
- [x] GET /user_role/user/@user_id
- [ ] POST /user_role/user/@user_id
- [ ] PUT /user_role/user/@user_id
- [ ] DELETE /user_role/user/@user_id

### Permissões
- [x] GET /roles
- [x] GET /role/id/@role_id
- [x] POST /role
- [x] PUT /role/id/@role_id
- [x] DELETE /role/id/@role_id