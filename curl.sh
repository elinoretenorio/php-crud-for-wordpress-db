curl -X GET "localhost:8080/wp-commentmeta"

curl -X POST "localhost:8080/wp-commentmeta" -H 'Content-Type: application/json' -d'
{
  "comment_id": 102,
  "meta_key": "positive",
  "meta_value": "Model media buy over authority impact such. For Democrat audience consider. Rather system few service believe."
}
'

curl -X POST "localhost:8080/wp-commentmeta/4754" -H 'Content-Type: application/json' -d'
{
  "comment_id": 102,
  "meta_id": 4754,
  "meta_key": "positive",
  "meta_value": "Model media buy over authority impact such. For Democrat audience consider. Rather system few service believe."
}
'

curl -X GET "localhost:8080/wp-commentmeta/4754"

curl -X DELETE "localhost:8080/wp-commentmeta/4754"

# --

curl -X GET "localhost:8080/wp-comments"

curl -X POST "localhost:8080/wp-comments" -H 'Content-Type: application/json' -d'
{
  "comment_agent": "themselves",
  "comment_approved": "tax",
  "comment_author": "Product yard lay move officer.",
  "comment_author_IP": "success",
  "comment_author_email": "lori35@example.net",
  "comment_author_url": "evidence",
  "comment_content": "Policy morning decision professor politics health social. Price two entire price. Live billion control summer firm.",
  "comment_date": "2021-09-27 19:58:57",
  "comment_date_gmt": "2021-10-10 10:06:10",
  "comment_karma": 3751,
  "comment_parent": 6877,
  "comment_post_ID": 20,
  "comment_type": "themselves",
  "user_id": 7628
}
'

curl -X POST "localhost:8080/wp-comments/2576" -H 'Content-Type: application/json' -d'
{
  "comment_ID": 2576,
  "comment_agent": "themselves",
  "comment_approved": "tax",
  "comment_author": "Product yard lay move officer.",
  "comment_author_IP": "success",
  "comment_author_email": "lori35@example.net",
  "comment_author_url": "evidence",
  "comment_content": "Policy morning decision professor politics health social. Price two entire price. Live billion control summer firm.",
  "comment_date": "2021-09-27 19:58:57",
  "comment_date_gmt": "2021-10-10 10:06:10",
  "comment_karma": 3751,
  "comment_parent": 6877,
  "comment_post_ID": 20,
  "comment_type": "themselves",
  "user_id": 7628
}
'

curl -X GET "localhost:8080/wp-comments/2576"

curl -X DELETE "localhost:8080/wp-comments/2576"

# --

curl -X GET "localhost:8080/wp-links"

curl -X POST "localhost:8080/wp-links" -H 'Content-Type: application/json' -d'
{
  "link_description": "behavior",
  "link_image": "stock",
  "link_name": "citizen",
  "link_notes": "Buy security strategy management example imagine. Reality well many must subject.",
  "link_owner": 8129,
  "link_rating": 9225,
  "link_rel": "learn",
  "link_rss": "radio",
  "link_target": "security",
  "link_updated": "2021-10-06 09:30:51",
  "link_url": "nation",
  "link_visible": "pass"
}
'

curl -X POST "localhost:8080/wp-links/5809" -H 'Content-Type: application/json' -d'
{
  "link_description": "behavior",
  "link_id": 5809,
  "link_image": "stock",
  "link_name": "citizen",
  "link_notes": "Buy security strategy management example imagine. Reality well many must subject.",
  "link_owner": 8129,
  "link_rating": 9225,
  "link_rel": "learn",
  "link_rss": "radio",
  "link_target": "security",
  "link_updated": "2021-10-06 09:30:51",
  "link_url": "nation",
  "link_visible": "pass"
}
'

curl -X GET "localhost:8080/wp-links/5809"

curl -X DELETE "localhost:8080/wp-links/5809"

# --

curl -X GET "localhost:8080/wp-options"

curl -X POST "localhost:8080/wp-options" -H 'Content-Type: application/json' -d'
{
  "autoload": "indeed",
  "option_name": "what",
  "option_value": "With more both any tree you indicate. Five head more recent ten wish. Positive the also field."
}
'

curl -X POST "localhost:8080/wp-options/6361" -H 'Content-Type: application/json' -d'
{
  "autoload": "indeed",
  "option_id": 6361,
  "option_name": "what",
  "option_value": "With more both any tree you indicate. Five head more recent ten wish. Positive the also field."
}
'

curl -X GET "localhost:8080/wp-options/6361"

curl -X DELETE "localhost:8080/wp-options/6361"

# --

curl -X GET "localhost:8080/wp-postmeta"

curl -X POST "localhost:8080/wp-postmeta" -H 'Content-Type: application/json' -d'
{
  "meta_key": "stand",
  "meta_value": "Wife under star campaign reduce however. Wife already share force win month skill crime. Agency indeed full run.",
  "post_id": 6936
}
'

curl -X POST "localhost:8080/wp-postmeta/7151" -H 'Content-Type: application/json' -d'
{
  "meta_id": 7151,
  "meta_key": "stand",
  "meta_value": "Wife under star campaign reduce however. Wife already share force win month skill crime. Agency indeed full run.",
  "post_id": 6936
}
'

curl -X GET "localhost:8080/wp-postmeta/7151"

curl -X DELETE "localhost:8080/wp-postmeta/7151"

# --

curl -X GET "localhost:8080/wp-posts"

curl -X POST "localhost:8080/wp-posts" -H 'Content-Type: application/json' -d'
{
  "comment_status": "turn",
  "guid": "produce",
  "menu_order": 4457,
  "ping_status": "current",
  "pinged": "Whether real court loss believe.",
  "post_author": 1911,
  "post_content": "Himself someone offer chair evidence. Necessary scientist method speech. Majority child realize other. She culture travel peace.",
  "post_content_filtered": "Production movie make despite board risk. Nice environmental population development team.",
  "post_date": "2021-09-15 18:58:17",
  "post_date_gmt": "2021-09-14 18:12:27",
  "post_excerpt": "Ahead per bit.",
  "post_mime_type": "never",
  "post_modified": "2021-10-05 23:48:11",
  "post_modified_gmt": "2021-09-17 20:58:12",
  "post_name": "part",
  "post_parent": 8891,
  "post_password": "next",
  "post_status": "try",
  "post_title": "Southern bill range wife new mother those. Foot significant property argue school.",
  "post_type": "commercial",
  "to_ping": "Policy car carry. Either decide adult several join former."
}
'

curl -X POST "localhost:8080/wp-posts/734" -H 'Content-Type: application/json' -d'
{
  "ID": 734,
  "comment_status": "turn",
  "guid": "produce",
  "menu_order": 4457,
  "ping_status": "current",
  "pinged": "Whether real court loss believe.",
  "post_author": 1911,
  "post_content": "Himself someone offer chair evidence. Necessary scientist method speech. Majority child realize other. She culture travel peace.",
  "post_content_filtered": "Production movie make despite board risk. Nice environmental population development team.",
  "post_date": "2021-09-15 18:58:17",
  "post_date_gmt": "2021-09-14 18:12:27",
  "post_excerpt": "Ahead per bit.",
  "post_mime_type": "never",
  "post_modified": "2021-10-05 23:48:11",
  "post_modified_gmt": "2021-09-17 20:58:12",
  "post_name": "part",
  "post_parent": 8891,
  "post_password": "next",
  "post_status": "try",
  "post_title": "Southern bill range wife new mother those. Foot significant property argue school.",
  "post_type": "commercial",
  "to_ping": "Policy car carry. Either decide adult several join former."
}
'

curl -X GET "localhost:8080/wp-posts/734"

curl -X DELETE "localhost:8080/wp-posts/734"

# --

curl -X GET "localhost:8080/wp-term-relationships"

curl -X POST "localhost:8080/wp-term-relationships" -H 'Content-Type: application/json' -d'
{
  "term_order": 6460,
  "term_taxonomy_id": 4523
}
'

curl -X POST "localhost:8080/wp-term-relationships/9099" -H 'Content-Type: application/json' -d'
{
  "object_id": 9099,
  "term_order": 6460,
  "term_taxonomy_id": 4523
}
'

curl -X GET "localhost:8080/wp-term-relationships/9099"

curl -X DELETE "localhost:8080/wp-term-relationships/9099"

# --

curl -X GET "localhost:8080/wp-term-taxonomy"

curl -X POST "localhost:8080/wp-term-taxonomy" -H 'Content-Type: application/json' -d'
{
  "count": 5296,
  "description": "Likely trip together thus. Suddenly security but while including.",
  "parent": 4383,
  "taxonomy": "section",
  "term_id": 7772
}
'

curl -X POST "localhost:8080/wp-term-taxonomy/5382" -H 'Content-Type: application/json' -d'
{
  "count": 5296,
  "description": "Likely trip together thus. Suddenly security but while including.",
  "parent": 4383,
  "taxonomy": "section",
  "term_id": 7772,
  "term_taxonomy_id": 5382
}
'

curl -X GET "localhost:8080/wp-term-taxonomy/5382"

curl -X DELETE "localhost:8080/wp-term-taxonomy/5382"

# --

curl -X GET "localhost:8080/wp-termmeta"

curl -X POST "localhost:8080/wp-termmeta" -H 'Content-Type: application/json' -d'
{
  "meta_key": "market",
  "meta_value": "Stage see thousand newspaper subject some ready. Foot once break sometimes another.",
  "term_id": 1725
}
'

curl -X POST "localhost:8080/wp-termmeta/8001" -H 'Content-Type: application/json' -d'
{
  "meta_id": 8001,
  "meta_key": "market",
  "meta_value": "Stage see thousand newspaper subject some ready. Foot once break sometimes another.",
  "term_id": 1725
}
'

curl -X GET "localhost:8080/wp-termmeta/8001"

curl -X DELETE "localhost:8080/wp-termmeta/8001"

# --

curl -X GET "localhost:8080/wp-terms"

curl -X POST "localhost:8080/wp-terms" -H 'Content-Type: application/json' -d'
{
  "name": "late",
  "slug": "hit",
  "term_group": 4491
}
'

curl -X POST "localhost:8080/wp-terms/9595" -H 'Content-Type: application/json' -d'
{
  "name": "late",
  "slug": "hit",
  "term_group": 4491,
  "term_id": 9595
}
'

curl -X GET "localhost:8080/wp-terms/9595"

curl -X DELETE "localhost:8080/wp-terms/9595"

# --

curl -X GET "localhost:8080/wp-usermeta"

curl -X POST "localhost:8080/wp-usermeta" -H 'Content-Type: application/json' -d'
{
  "meta_key": "itself",
  "meta_value": "Sort model east front picture. Throw floor government stay former.",
  "user_id": 2146
}
'

curl -X POST "localhost:8080/wp-usermeta/9655" -H 'Content-Type: application/json' -d'
{
  "meta_key": "itself",
  "meta_value": "Sort model east front picture. Throw floor government stay former.",
  "umeta_id": 9655,
  "user_id": 2146
}
'

curl -X GET "localhost:8080/wp-usermeta/9655"

curl -X DELETE "localhost:8080/wp-usermeta/9655"

# --

curl -X GET "localhost:8080/wp-users"

curl -X POST "localhost:8080/wp-users" -H 'Content-Type: application/json' -d'
{
  "display_name": "despite",
  "user_activation_key": "able",
  "user_email": "teresamayo@example.com",
  "user_login": "left",
  "user_nicename": "body",
  "user_pass": "member",
  "user_registered": "2021-10-11 22:08:19",
  "user_status": 8332,
  "user_url": "college"
}
'

curl -X POST "localhost:8080/wp-users/5518" -H 'Content-Type: application/json' -d'
{
  "ID": 5518,
  "display_name": "despite",
  "user_activation_key": "able",
  "user_email": "teresamayo@example.com",
  "user_login": "left",
  "user_nicename": "body",
  "user_pass": "member",
  "user_registered": "2021-10-11 22:08:19",
  "user_status": 8332,
  "user_url": "college"
}
'

curl -X GET "localhost:8080/wp-users/5518"

curl -X DELETE "localhost:8080/wp-users/5518"

# --

