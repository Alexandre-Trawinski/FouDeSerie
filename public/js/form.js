new TomSelect("#serie_lesGenres", {
    
    render: {
      option: function(data, escape) {
        return '<div class="d-flex"><span>' + escape(data.text) + '</span></div>';
      },
      item: function(data, escape) {
        return '<div>' + escape(data.text) + '</div>';
      }
    }
  });
  