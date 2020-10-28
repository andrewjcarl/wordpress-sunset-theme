<?php
/**
 * Prism Syntax Highlighting Shortcode
 * 
 * @since   1.0.0
 */

if ( ! class_exists( 'PrismSyntax' ) ) :

    class PrismSyntax {

        private $shortcodes;
        
        public function __construct() {
            
            add_action( 'init', array( $this, 'register_shortcodes' ) );
            
            $this->shortcodes = (array) array(
                'css',
                'scss',
                'php',
                'javascript',
                'html',
            );
        }

        public function register_shortcodes() {
            foreach( $this->shortcodes as $shortcode ) {
                add_shortcode( $shortcode, array( $this, 'shortcode_callback') );
            }
        }

        public static function shortcode_callback( $atts, $content, $tag ) {
            $code_class = 'language-' . $tag;

            return '<pre><code class="' . $code_class . '">' . do_shortcode($content) . '</code></pre>';
        }
    }

endif; 

return new PrismSyntax();