Cypress.Commands.add('login', () => {
  const user = {
    email: "admin@admin.com",
    senha: "admin@1234"
  };

  cy.visit('/login');
  cy.get('input[name="email"]').type(user.email);
  cy.get('input[name="password"]').type(user.senha);
  cy.get('button[type="submit"]').click();
  cy.url().should('include', '/home');
});

Cypress.Commands.add('urna', () =>{
  cy.get('a.nav-link').contains('Urnas').click();
  cy.url().should('include', '/urna');
  cy.get('.h2').should('contain', 'Urnas');
});

describe('Teste do CRUD da urna', () =>{
  const urna= {
    nome: 'Caixão Premium',
    tipo: 'Caixão',
    material: 'Metal',
    valor: 25000,
    nomeTrocado: 'Caixão Master',
    valorTrocado: 500,
    valorNegativo: -100
  };

  it('Deve adicionar uma nova urna', () =>{
    cy.login();
    cy.urna();
    cy.get('.card-body .btn').contains('Nova Urna').click();
    cy.get('#createUrnaModal').should('be.visible');
    cy.get('#urna_nome').type(urna.nome);
    cy.get('#urna_tipo').select(urna.tipo);
    cy.get('#urna_material').select(urna.material);
    cy.get('#urna_preco').type(urna.valor);
    cy.get('#createUrnaModal').find('button[type="submit"]').click();
    cy.contains('Urna criada com sucesso.').should('be.visible');
    cy.get('table tbody tr:last-child')
      .should('contain', urna.nome)
      .and('contain', urna.tipo)
      .and('contain', urna.material)
  });

  it('Tentativa de criar uma urna com o nome faltando', () =>{
    cy.login();
    cy.urna();
    cy.get('.card-body .btn').contains('Nova Urna').click();
    cy.get('#createUrnaModal').should('be.visible');
    cy.get('#urna_nome').clear();
    cy.get('#urna_tipo').select(urna.tipo);
    cy.get('#urna_material').select(urna.material);
    cy.get('#urna_preco').type(urna.valor);
    cy.get('#createUrnaModal').find('button[type="submit"]').click();
    cy.get('#urna_nome')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de criar uma urna com o preço faltando', () =>{
    cy.login();
    cy.urna();
    cy.get('.card-body .btn').contains('Nova Urna').click();
    cy.get('#createUrnaModal').should('be.visible');
    cy.get('#urna_nome').type(urna.nome);
    cy.get('#urna_tipo').select(urna.tipo);
    cy.get('#urna_material').select(urna.material);
    cy.get('#urna_preco').clear();
    cy.get('#createUrnaModal').find('button[type="submit"]').click();
    cy.get('#urna_preco')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de editar uma urna com sucesso', () => {
    cy.login();
    cy.urna();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editUrnaModal').should('be.visible');
    cy.get('#edit_urna_nome')
      .clear()
      .type(urna.nomeTrocado);
    cy.get('#edit_urna_tipo').select(urna.tipo);
    cy.get('#edit_urna_material').select(urna.material);  
    cy.get('#edit_urna_preco')
      .clear()
      .type(urna.valor);
    cy.get('#editUrnaModal').find('button[type="submit"]').click();
    cy.contains('Urna atualizada com sucesso').should('be.visible');
    cy.get('table tbody tr:first-child')
      .should('contain', urna.nomeTrocado);
  });

  it('Tentativa de editar com o nome faltando', () => {
    cy.login();
    cy.urna();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editUrnaModal').should('be.visible');
    cy.get('#edit_urna_nome')
      .clear();
    cy.get('#edit_urna_tipo').select(urna.tipo);
    cy.get('#edit_urna_material').select(urna.material);  
    cy.get('#edit_urna_preco')
      .clear()
      .type(urna.valor);
    cy.get('#editUrnaModal').find('button[type="submit"]').click();
    cy.get('#edit_urna_nome')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de editar com o preço faltando', () => {
    cy.login();
    cy.urna();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editUrnaModal').should('be.visible');
    cy.get('#edit_urna_nome')
      .clear()
      .type(urna.nome);
    cy.get('#edit_urna_tipo').select(urna.tipo);
    cy.get('#edit_urna_material').select(urna.material);  
    cy.get('#edit_urna_preco')
      .clear();
    cy.get('#editUrnaModal').find('button[type="submit"]').click();
    cy.get('#edit_urna_preco')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de editar com o preço negativo', () => {
    cy.login();
    cy.urna();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editUrnaModal').should('be.visible');
    cy.get('#edit_urna_nome')
      .clear()
      .type(urna.nome);
    cy.get('#edit_urna_tipo').select(urna.tipo);
    cy.get('#edit_urna_material').select(urna.material);  
    cy.get('#edit_urna_preco')
      .clear()
      .type(urna.valorNegativo);
    cy.get('#editUrnaModal').find('button[type="submit"]').click();
    cy.get('#edit_urna_preco')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('O valor deve ser maior ou igual a 1.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Deletar uma urna com sucesso', () =>{
    cy.login();
    cy.urna();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('.d-inline > .btn') 
      .click();
    cy.contains('Urna excluída com sucesso.').should('be.visible');
  });

});