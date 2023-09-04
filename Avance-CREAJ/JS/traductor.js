
          // Crear un elemento <script> para cargar el script de traducción de Google
          const script = document.createElement('script');
          script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
          script.async = true;
          document.body.appendChild(script);
        
          // Función para manejar los cambios en el estilo del cuerpo
          const handleBodyChanges = () => {
            const currentTop = parseInt(document.body.style.top) || 0;
            if (currentTop > 0) {
              document.body.style.top = '0px';
            }
          };
        
          // Definir la función global googleTranslateElementInit
          window.googleTranslateElementInit = () => {
            if (!document.querySelector('.goog-te-combo')) {
              new window.google.translate.TranslateElement(
                { pageLanguage: 'es', includedLanguages: 'en,es' },
                'google_translate_element'
              );
            }
        
            // Observar los cambios en el estilo del cuerpo
            const observer = new MutationObserver(handleBodyChanges);
            observer.observe(document.body, { attributes: true, attributeFilter: ['style'] });
          };