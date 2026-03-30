<?php
/**
 * Branding single — layout: default
 *
 * Struktura:
 * 1. Nagłówek 2-kol: tytuł + opis po lewej | metadata po prawej
 * 2. Sekcje opisowe (Misja / Wizja z ACF)
 * 3. Strefa Gutenberga — the_content()
 * 4. Paleta kolorów (ACF)
 * 5. Logo warianty (ACF)
 * 6. Nawigacja prev/next
 *
 * @package MyBeeWeb-Child-Kadence-Theme
 */

if ( ! function_exists( 'get_field' ) ) {
	return;
}

$firma         = get_field( 'branding_firma' );
$rok           = get_field( 'branding_rok' );
$branza        = get_field( 'branding_branza' );
$misja_label   = get_field( 'branding_misja_label' ) ?: 'Misja';
$misja         = get_field( 'branding_misja' );
$wizja_label   = get_field( 'branding_wizja_label' ) ?: 'Wizja';
$wizja         = get_field( 'branding_wizja' );
$hero_bg       = get_field( 'branding_hero_kolor_tla' ) ?: '#1a1a1a';
$kolor1        = get_field( 'branding_kolor_1' );
$kolor1_nazwa  = get_field( 'branding_kolor_1_nazwa' );
$kolor2        = get_field( 'branding_kolor_2' );
$kolor2_nazwa  = get_field( 'branding_kolor_2_nazwa' );
$kolor3        = get_field( 'branding_kolor_3' );
$kolor3_nazwa  = get_field( 'branding_kolor_3_nazwa' );
$font_h        = get_field( 'branding_czcionka_naglowki' );
$font_t        = get_field( 'branding_czcionka_tekst' );
$logo_na_ciemnym = get_field( 'branding_logo_jasne' );   // jasne znaki → ciemne tło
$logo_na_jasnym  = get_field( 'branding_logo_ciemne' );  // ciemne znaki → jasne tło
$znak1_obraz     = get_field( 'branding_znak1_obraz' );
$znak1_opis      = get_field( 'branding_znak1_opis' );
$znak2_obraz     = get_field( 'branding_znak2_obraz' );
$znak2_opis      = get_field( 'branding_znak2_opis' );

?>
<article class="branding-single">

	<!-- =============================================
	     1. NAGŁÓWEK — 2 kolumny
	     ============================================= -->
	<section class="branding-naglowek site-container">
		<div class="branding-naglowek__lewo">
			<span class="branding-naglowek__label">BRANDING</span>
			<h1 class="branding-naglowek__tytul"><?php the_title(); ?></h1>
			<?php if ( $misja ) : ?>
				<div class="branding-naglowek__opis"><?php echo wp_kses_post( nl2br( $misja ) ); ?></div>
			<?php endif; ?>
		</div>
		<div class="branding-naglowek__prawo">
			<?php if ( $firma ) : ?>
			<div class="branding-meta">
				<span class="branding-meta__label">Klient</span>
				<span class="branding-meta__wartosc"><?php echo esc_html( $firma ); ?></span>
			</div>
			<?php endif; ?>
			<?php if ( $branza ) : ?>
			<div class="branding-meta">
				<span class="branding-meta__label">Branża</span>
				<span class="branding-meta__wartosc"><?php echo esc_html( $branza ); ?></span>
			</div>
			<?php endif; ?>
			<?php if ( $rok ) : ?>
			<div class="branding-meta">
				<span class="branding-meta__label">Rok</span>
				<span class="branding-meta__wartosc"><?php echo esc_html( $rok ); ?></span>
			</div>
			<?php endif; ?>
			<?php if ( $font_h ) : ?>
			<div class="branding-meta">
				<span class="branding-meta__label">Typografia</span>
				<span class="branding-meta__wartosc"><?php echo esc_html( $font_h ); ?><?php echo $font_t ? ' / ' . esc_html( $font_t ) : ''; ?></span>
			</div>
			<?php endif; ?>
		</div>
	</section>

	<!-- =============================================
	     3. SEKCJA WIZJA (opcjonalna)
	     ============================================= -->
	<?php if ( $wizja ) : ?>
	<section class="branding-wizja site-container">
		<h2 class="branding-sekcja-label"><?php echo esc_html( $wizja_label ); ?></h2>
		<div class="branding-wizja__tresc"><?php echo wp_kses_post( nl2br( $wizja ) ); ?></div>
	</section>
	<?php endif; ?>

	<!-- =============================================
	     4. STREFA GUTENBERGA
	     (tutaj dodajesz bloki w edytorze)
	     ============================================= -->
	<div class="branding-content-zone">
		<?php the_content(); ?>
	</div>

	<!-- =============================================
	     5. PALETA KOLORÓW
	     ============================================= -->
	<?php
	$kolory = array_filter( [
		[ 'hex' => $hero_bg,  'nazwa' => '' ],
		[ 'hex' => $kolor1,   'nazwa' => $kolor1_nazwa ],
		[ 'hex' => $kolor2,   'nazwa' => $kolor2_nazwa ],
		[ 'hex' => $kolor3,   'nazwa' => $kolor3_nazwa ],
	], fn( $k ) => ! empty( $k['hex'] ) );
	?>
	<?php if ( $kolory ) : ?>
	<section class="branding-paleta site-container">
		<h2 class="branding-sekcja-label">Paleta kolorów</h2>
		<div class="branding-paleta__kolory">
			<?php foreach ( $kolory as $k ) : ?>
			<div class="branding-kolor">
				<div class="branding-kolor__swatch" style="background-color:<?php echo esc_attr( $k['hex'] ); ?>;"></div>
				<?php if ( $k['nazwa'] ) : ?>
					<span class="branding-kolor__nazwa"><?php echo esc_html( $k['nazwa'] ); ?></span>
				<?php endif; ?>
				<span class="branding-kolor__hex"><?php echo esc_html( strtoupper( $k['hex'] ) ); ?></span>
			</div>
			<?php endforeach; ?>
		</div>
	</section>
	<?php endif; ?>

	<!-- =============================================
	     6. LOGO WARIANTY (karty z zaokrąglonymi rogami)
	     ============================================= -->
	<?php if ( $logo_na_jasnym || $logo_na_ciemnym ) : ?>
	<section class="branding-logo site-container">
		<div class="branding-logo__layout">
			<div class="branding-logo__opis">
				<h2 class="branding-sekcja-label">Logo</h2>
				<p class="branding-logo__tekst">Warianty znaku graficznego przygotowane do użycia na jasnym i ciemnym tle.</p>
			</div>
			<div class="branding-logo__karty">
				<?php if ( $logo_na_jasnym ) : ?>
				<div class="branding-karta branding-karta--jasne">
					<img src="<?php echo esc_url( $logo_na_jasnym['url'] ); ?>"
					     alt="<?php echo esc_attr( $logo_na_jasnym['alt'] ?: 'Logo — wersja podstawowa' ); ?>">
				</div>
				<?php endif; ?>
				<?php if ( $logo_na_ciemnym ) : ?>
				<div class="branding-karta branding-karta--ciemne" style="background-color:<?php echo esc_attr( $hero_bg ); ?>;">
					<img src="<?php echo esc_url( $logo_na_ciemnym['url'] ); ?>"
					     alt="<?php echo esc_attr( $logo_na_ciemnym['alt'] ?: 'Logo — wersja odwrócona' ); ?>">
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- =============================================
	     7. ZNAKI WIZUALNE (karty z zaokrąglonymi rogami)
	     ============================================= -->
	<?php if ( $znak1_obraz || $znak2_obraz ) : ?>
	<section class="branding-znaki site-container">
		<div class="branding-znaki__layout">
			<div class="branding-znaki__opis">
				<h2 class="branding-sekcja-label">Znaki wizualne</h2>
				<?php if ( $znak1_opis ) : ?>
				<p class="branding-znaki__tekst"><?php echo wp_kses_post( nl2br( $znak1_opis ) ); ?></p>
				<?php endif; ?>
				<?php if ( $znak2_opis ) : ?>
				<p class="branding-znaki__tekst"><?php echo wp_kses_post( nl2br( $znak2_opis ) ); ?></p>
				<?php endif; ?>
			</div>
			<div class="branding-znaki__karty">
				<?php if ( $znak1_obraz ) : ?>
				<div class="branding-karta branding-karta--jasne">
					<img src="<?php echo esc_url( $znak1_obraz['url'] ); ?>"
					     alt="<?php echo esc_attr( $znak1_obraz['alt'] ?: 'Znak wizualny' ); ?>">
				</div>
				<?php endif; ?>
				<?php if ( $znak2_obraz ) : ?>
				<div class="branding-karta branding-karta--jasne">
					<img src="<?php echo esc_url( $znak2_obraz['url'] ); ?>"
					     alt="<?php echo esc_attr( $znak2_obraz['alt'] ?: 'Znak wizualny — wariant' ); ?>">
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- =============================================
	     8. NAWIGACJA
	     ============================================= -->
	<nav class="branding-nawigacja site-container">
		<?php
		$prev = get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		?>
		<div class="branding-nawigacja__prev">
			<?php if ( $prev ) : ?>
				<a href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
					&larr; <?php echo esc_html( get_the_title( $prev ) ); ?>
				</a>
			<?php endif; ?>
		</div>
		<div class="branding-nawigacja__all">
			<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'portfolio' ) ) ); ?>">
				Wszystkie projekty
			</a>
		</div>
		<div class="branding-nawigacja__next">
			<?php if ( $next ) : ?>
				<a href="<?php echo esc_url( get_permalink( $next ) ); ?>">
					<?php echo esc_html( get_the_title( $next ) ); ?> &rarr;
				</a>
			<?php endif; ?>
		</div>
	</nav>

</article><!-- .branding-single -->
