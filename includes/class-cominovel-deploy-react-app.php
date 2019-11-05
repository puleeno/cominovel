<?php
class Cominovel_Deploy_React_App {
	protected $asset_config_file;
	protected $root_dir;
	protected $current_configs;
	protected $copied_files;

	public function __construct() {
		$this->bootstrap();
		$this->clean_old_file();
		$this->copy_new_files();
		$this->export_asset_configs();
		$this->clean_build_folder();
	}

	public function bootstrap() {
		$this->root_dir          = realpath( dirname( __FILE__ ) . '/..' );
		$this->asset_config_file = sprintf( '%s/assets.config.php', $this->root_dir );
		if ( file_exists( $this->asset_config_file ) ) {
			$this->current_configs = require $this->asset_config_file;
		}
	}

	public function clean_old_file() {
		if ( ! is_array( $this->current_configs ) || empty( $this->current_configs ) ) {
			return;
		}
		foreach ( (array) $this->current_configs as $asset_type => $asset_files ) {
			foreach ( $asset_files as $asset_file ) {
				$asset_file = sprintf( '%s/assets/%s/%s', $this->root_dir, $asset_type, $asset_file );
				if ( file_exists( $asset_file ) ) {
					unlink( $asset_file );
				}
				$map_file = $asset_file . '.map';
				if ( file_exists( $map_file ) ) {
					unlink( $map_file );
				}
			}
		}
	}

	public function copy_new_files() {
		$static_dir = sprintf( '%s/build/static', $this->root_dir );
		$dest       = sprintf( '%s/assets', $this->root_dir );
		$this->copy( $static_dir, $dest );
	}

	public function copy( $source, $dest ) {
		if ( ! file_exists( $dest ) ) {
			@mkdir( $dest, 0755, true );
		}
		if ( is_file( $source ) ) {
			$file_name = basename( $source );
			$dest_file = sprintf( '%s/%s', $dest, $file_name );
			if ( copy( $source, $dest_file ) && substr( $dest_file, -4 ) !== '.map' ) {
				$copied_file          = str_replace( sprintf( '%s/assets/', $this->root_dir ), '', $dest_file );
				$this->copied_files[] = $copied_file;
			}
		} else {
			$files = glob( $source . '/*' );
			foreach ( $files as $file ) {
				if ( is_dir( $file ) ) {
					$dir_name = basename( $file );
					$this->copy( $file, sprintf( '%s/%s', $dest, $dir_name ) );
				} else {
					$this->copy( $file, $dest );
				}
			}
		}
	}


	public function export_asset_configs() {
		$configs = array();
		foreach ( (array) $this->copied_files as $copied_file ) {
			$copied_file_arr         = explode( '/', $copied_file );
			list($asset_type, $file) = $copied_file_arr;
			$detect                  = explode( '.', $file );
			$key                     = array_shift( $detect );

			if ( is_numeric( $key ) ) {
				$configs[ $asset_type ]['library'] = $file;
			} elseif ( $key === 'main' ) {
				$configs[ $asset_type ]['main'] = $file;
			} elseif ( $key === 'runtime-main' ) {
				$configs[ $asset_type ]['runtime'] = $file;
			} else {
				$configs[ $asset_type ][] = $file;
			}
		}
		$configs = var_export( $configs, true );
		$h       = fopen( $this->asset_config_file, 'w' );

		fwrite( $h, sprintf( '<?php%1$s%2$s;%1$s', "\n", $configs ) );
		fclose( $h );
	}

	public function clean_build_folder() {
		$build_dir = sprintf( '%s/build', $this->root_dir );
		if ( file_exists( $build_dir ) ) {
			$this->clean_build_file( $build_dir );
		}
	}

	public function clean_build_file( $dir_or_file ) {
		if ( is_file( $dir_or_file ) ) {
			@unlink( $dir_or_file );
		} else {
			$files = glob( $dir_or_file . '/*' );
			if ( ! empty( $files ) ) {
				foreach ( $files as $file ) {
					$this->clean_build_file( $file );
				}
			}
			@rmdir( $dir_or_file );
		}
	}
}

new Cominovel_Deploy_React_App();
