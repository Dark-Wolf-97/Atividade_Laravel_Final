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

Cypress.Commands.add('velorio', () =>{
  cy.get('a.nav-link').contains('Velórios').click();
  cy.url().should('include', '/velorio');
  cy.get('.h2').should('contain', 'Velórios');
});

describe('Teste do CRUD do velório', () =>{
  const velorio={
    data: "2025-10-25",
    dataInvalida:"2023-10-05",
    finado: 1,
    urna: 1,
    finadoTrocado: 2,
    urnaTrocada: 2
  };

  it('Deve adicionar um novo velório', () =>{
    cy.login();
    cy.velorio();
    cy.get('.card-body .btn').contains('Novo Velório').click();
    cy.get('#createVelorioModal').should('be.visible');
    cy.get('#finado_id').select(velorio.finado);
    cy.get('#urna_id').select(velorio.urna);
    cy.get('#velorio_data').type(velorio.data);
    cy.get('#createVelorioModal').find('button[type="submit"]').click();
    cy.contains('Velório criado com sucesso.').should('be.visible');
  });

  it('Tentativa de criar um novo velorio sem data', () =>{
    cy.login();
    cy.velorio();
    cy.get('.card-body .btn').contains('Novo Velório').click();
    cy.get('#createVelorioModal').should('be.visible');
    cy.get('#finado_id').select(velorio.finado);
    cy.get('#urna_id').select(velorio.urna);
    cy.get('#velorio_data').clear();
    cy.get('#createVelorioModal').find('button[type="submit"]').click();
    cy.get('#velorio_data')
    .then(($input) => {
      expect($input[0].validationMessage).to.eq('Preencha este campo.');
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it('Tentativa de criar um novo velorio com uma data inválida', () =>{
    cy.login();
    cy.velorio();
    cy.get('.card-body .btn').contains('Novo Velório').click();
    cy.get('#createVelorioModal').should('be.visible');
    cy.get('#finado_id').select(velorio.finado);
    cy.get('#urna_id').select(velorio.urna);
    cy.get('#velorio_data').type(velorio.dataInvalida);
    cy.get('#createVelorioModal').find('button[type="submit"]').click();
    cy.get('#velorio_data')
    .then(($input) => {
      expect($input[0].checkValidity()).to.be.false;
    });
  });

  it("Deve atualizar o velório com sucesso", () =>{
    cy.login();
    cy.velorio();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('button.btn-dark') 
      .click();
    cy.get('#editVelorioModal').should('be.visible');
    cy.get('#edit_finado_id').type(velorio.finadoTrocado);
    cy.get('#edit_urna_id').type(velorio.finadoTrocado);
    cy.get('#edit_velorio_data').type(velorio.data);
    cy.get('#editVelorioModal').find('button[type="submit"]').click();
    cy.contains('Velório atualizado com sucesso.').should('be.visible');
  });

  it("Deve deletar o velório", () =>{
    cy.login();
    cy.velorio();
    cy.get('.table').should('have.length.gte', 1);
    cy.get('.table tr:first-child')
      .find('.d-inline > .btn') 
      .click();
    cy.contains('Velório excluído com sucesso.').should('be.visible');
  });
});