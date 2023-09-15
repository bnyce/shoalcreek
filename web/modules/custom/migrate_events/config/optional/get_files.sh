#!/usr/bin/env zsh

# Declare an array of missing field.storage.node.* files
declare -a missing_files=(
  "field_body.yml"
  "field_attendance.yml"
  "field_audience_text.yml"
  "field_canceled.yml"
  "field_cat_ia.yml"
  "field_community_services_outreac.yml"
  "field_ev_reflection_category.yml"
  "field_first_item.yml"
  "field_import_an_item_after_savin.yml"
  "field_invisible.yml"
  "field_is_there_a_fee_for_attendi.yml"
  "field_isbn_for_image3.yml"
  "field_item_list.yml"
  "field_kids_block_party_category.yml"
  "field_link_for_registration.yml"
  "field_metadata_description.yml"
  "field_metadata_image.yml"
  "field_movie_image.yml"
  "field_movie_rating.yml"
  "field_movie_summary.yml"
  "field_movie_title.yml"
  "field_movie_year.yml"
  "field_omit_category_description.yml"
  "field_print_view_height_tweak.yml"
  "field_promote_in_remote.yml"
  "field_ref_searchable_audience.yml"
  "field_reflected.yml"
  "field_remote_location.yml"
  "field_show_full_description.yml"
  "field_skip_apl_tv.yml"
  "field_slr_time_end.yml"
  "field_slr_time_start.yml"
  "field_sponsors.yml"
  "field_subtitle.yml"
  "field_title40.yml"
  "layout_builder__layout.yml"
  "field_central_event_location_exhibit.yml"
)

# Loop through the array and copy each file from ../config/ to the current directory
for file in "${missing_files[@]}"; do
  cp "../config/field.storage.node.${file}" "./field.storage.node.${file}"
done

echo "Copy operation completed."

