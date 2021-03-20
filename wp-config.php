<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', '_omsubi_jv61wgzt' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', '_omsubi_jv61wgzt' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'coheviop949g' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql015.phy.heteml.lan' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '%j$i6%a8;=A-&j[0%(_IZLz0{E!?AEhE*k(%pg$5yE(4)}u.E*U8UKyus0$._kQC' );
define( 'SECURE_AUTH_KEY',  'LWH[^K<.t^(0V0#48X2S!rDthH66.M~Y$kt|;9J8^PztG2nFQg2RN`B;g|-toKHs' );
define( 'LOGGED_IN_KEY',    ';[+B[SAP#?}I.&rclj:?9PEgrQPW51E,.NME9qx#9;L.[]o662<5IVb@&-q9#:-:' );
define( 'NONCE_KEY',        'cXScDGfDV,PrD_oA=4`ZP1uU#aV%ph?I`l%d-k!hvRO>p^S6=sWgjG[l!rqqP9?o' );
define( 'AUTH_SALT',        'k^Iw8JUt4$#k{UhND^:(eGsg=YNhXgL}4y:2|il]ln6!}dPg1dmW$V][/j2kFE#~' );
define( 'SECURE_AUTH_SALT', ']=]U07qblnd%G.l}qNyu$-&<v81@D4Ua.q:#o5eQi}V+K{I[o{&rI-8^+0OMu#)6' );
define( 'LOGGED_IN_SALT',   't[9Y=d+z5f9G6HbkihS,sRE1HwE]zL?jh>|ywHor(o>#;tnyR{9~rD@??ZL*&erm' );
define( 'NONCE_SALT',       'w+bjRGQY;iaASE?%e>DMVYfo=-x^pf9cpbB{#wy=VPS*yl.T3P9P*f^`r-TWrT?W' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

add_filter('xmlrpc_enabled', '__return_false');

add_filter('xmlrpc_methods', function($methods) {
    unset($methods['pingback.ping']);
    unset($methods['pingback.extensions.getPingbacks']);
    return $methods;
});