function loadItems(element, path, selectInputClass) {
  var selectedVal = $(element).val();

  // select all
  if (selectedVal == -1) {
    return;
  }

  $.ajax({
  type: 'GET',
  url: path + selectedVal,
  success: function (datas) {
    if (!datas || datas.length === 0) {
       return;
    }

    for (var  i = 0; i < datas.length; i++) {
      $(selectInputClass).append($('<option>', {
        value: datas[i].id,
        text: datas[i].name
    }));
    }
  },
  error: function (ex) {
  }
  });
}

function loadStates(element) {
  $('.js-states').empty().append('<option value="-1">Please select your state</option>');
  $('.js-cities').empty().append('<option value="-1">Please select your city</option>');
  loadItems(element, '../../api/states/', '.js-states');
}

function loadCitiesCreate(element) {
  $('.js-cities_create').empty().append('<option value="-1">Selecione a Cidade</option>');;
  loadItems(element, '../../api/cities_create/', '.js-cities_create');
}

function loadCitiesEdit(element) {
  $('.js-cities_edit').empty().append('<option value="-1">Selecione a Cidade</option>');;
  loadItems(element, '../../../api/cities_edit/', '.js-cities_edit');
}

function loadSubcategories(element) {
  $('.js-subcategories').empty().append('<option value="">Selecione a Sub-Categoria</option>');;
  loadItems(element, '../api/subcategories_create/', '.js-subcategories');
}

function loadSubcategoriesCreate(element) {
  $('.js-subcategories_create').empty().append('<option value="">Selecione a Sub-Categoria</option>');;
  loadItems(element, '../../api/subcategories_create/', '.js-subcategories_create');
}

function loadSubcategoriesEdit(element) {
  $('.js-subcategories_edit').empty().append('<option value="-1">Selecione a Sub-Categoria</option>');;
  loadItems(element, '../../../api/subcategories_edit/', '.js-subcategories_edit');
}

function loadSpecificationsCreate(element) {
  $('.js-specifications_create').empty().append('<option value="-1">Selecione a Especificação</option>');;
  loadItems(element, '../../../api/specifications_create/', '.js-specifications_create');
}

function loadRelationshipCreate(element) {
  $('.js-relationship_create').empty().append('<option value="-1">Selecione a Subcategoria</option>');;
  loadItems(element, '../../../api/subcategories_create/', '.js-relationship_create');
}

function loadRelationshipProductCreate(element) {
  $('.js-products_relationship_create').empty().append('<option value="-1">Selecione aqui o Produto</option>');;
  loadItems(element, '../../../api/products_relationships_create/', '.js-products_relationship_create');
}

function loadSpecificationsEdit(element) {
  $('.js-specifications_edit').empty().append('<option value="-1">Selecione a Especificação</option>');;
  loadItems(element, '../../../../api/specifications_edit/', '.js-specifications_edit');
}


function registerEvents() {
  $('.js-country').change(function() {
    loadStates(this);
  });

  $('.js-states_create').change(function() {
    loadCitiesCreate(this);
  });

  $('.js-states_edit').change(function() {
    loadCitiesEdit(this);
  });

  $('.js-categories').change(function() {
    loadSubcategories(this);
  });

  $('.js-categories_create').change(function() {
    loadSubcategoriesCreate(this);
  });

  $('.js-categories_edit').change(function() {
    loadSubcategoriesEdit(this);
  });

  $('.js-categories_spec_create').change(function() {
    loadSpecificationsCreate(this);
  });

  $('.js-specifications_edit').change(function() {
    loadSpecificationsEdit(this);
  });

  $('.js-relationship_rel_create').change(function() {
    loadRelationshipCreate(this);
  });

  $('.js-relationship_create').change(function() {
    loadRelationshipProductCreate(this);
  });
}

function init() {
  registerEvents();
}

init();