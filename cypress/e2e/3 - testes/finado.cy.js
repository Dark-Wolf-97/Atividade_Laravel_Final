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

Cypress.Commands.add('finado', () =>{
  cy.get('a.nav-link').contains('Finados').click();
  cy.url().should('include', '/finado');
  cy.get('.h2').should('contain', 'Finados');
});

describe('Teste do CRUD do finado', () =>{

  const finado ={
    nome: "John Doe",
    certidao:"123456789",
    nomeTrocado: "Fulano da Silva",
    certidaoTrocada:'987654321'
  };

  it('Deve adicionar um finado', () =>{
    cy.login();
    cy.finado();
    cy.get('.card-body .btn').contains('Novo Finado').click();
    cy.get('#createFinadoModal').should('be.visible');
    cy.get('#finado_nome').type(finado.nome);
    cy.get('#finado_certidao').type(finado.certidao);
    cy.get('#createFinadoModal').find('button[type="submit"]').click();
    cy.contains('Finado criado com sucesso.').should('be.visible');
    cy.get('table tbody tr:last-child')
      .should('contain', finado.nome)
      .and('contain', finado.certidao);
  });

  it('Tentativa de criar um finado com o nome faltando', () =>{
    cy.login();
    cy.finado();
    cy.get('#createFinadoModal').should('be.visible');
    cy.get('#finado_nome').clear();
    cy.get('#finado_certidao').type(finado.certidao);
    cy.get('#createFinadoModal').find('button[type="submit"]').click();

    cy.get('#finado_nome')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de criar um finado com a certidão faltando', () =>{
    cy.login();
    cy.finado();
    cy.get('#finado_nome').type(finado.nome);
    cy.get('#finado_certidao').clear();
    cy.get('#createFinadoModal').find('button[type="submit"]').click();

    cy.get('#finado_certidao')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Deve editar um finado com sucesso', () => {
    cy.login();
    cy.finado();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editFinadoModal').should('be.visible');
    cy.get('#edit_finado_nome')
      .clear()
      .type(finado.nomeTrocado);
    cy.get('#edit_finado_certidao')
      .clear()
      .type(finado.certidaoTrocada);
    cy.get('#editFinadoModal')
      .find('button[type="submit"]')
      .click();
    cy.contains('Finado atualizado com sucesso').should('be.visible');
    cy.get('table tbody tr:first-child')
      .should('contain', finado.nomeTrocado)
      .and('contain', finado.certidaoTrocada);
  });

  it('Tentativa de editar um finado com o nome faltando', () => {
    cy.login();
    cy.finado();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editFinadoModal').should('be.visible');
    cy.get('#edit_finado_nome')
      .clear();
    cy.get('#edit_finado_certidao')
      .clear()
      .type(finado.certidaoTrocada);
    cy.get('#editFinadoModal')
      .find('button[type="submit"]')
      .click();
    cy.get('#edit_finado_nome')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de editar um finado com a certidão faltando', () => {
    cy.login();
    cy.finado();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editFinadoModal').should('be.visible');
    cy.get('#edit_finado_nome')
      .clear()
      .type(finado.nomeTrocado);
    cy.get('#edit_finado_certidao')
      .clear()
    cy.get('#editFinadoModal')
      .find('button[type="submit"]')
      .click();
    cy.get('#edit_finado_certidao')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it("Deve deletar um finado com sucesso", () =>{
    cy.login();
    cy.finado();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('.d-inline > .btn') 
      .click();
    cy.contains('Finado excluído com sucesso.').should('be.visible');
  });

});