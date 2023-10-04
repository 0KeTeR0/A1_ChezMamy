<?php

namespace App\Chezmamy\Model;

use App\Chezmamy\Lib\DatabaseConnection;
/** Class receiving the form's data  **/
class UserModel
{

    private ?string $email;
    private ?string $password;
    private ?string $last_name;
    private ?string $first_name;
    private ?string $date_of_birth;
    private ?string $nationality;
    private ?string $phone;
    private ?string $parents_adress;
    private ?string $city;
    private ?string $postal_code;
    private ?string $know_association;
    private ?string $education_level;
    private ?string $interships;
    private ?string $establishment;
    private ?string $end_of_studies;
    private ?string $date_of_arrival;
    private ?string $motivation;
    private bool $is_smoking;
    private bool $is_allergic;
    private ?string $allergies;
    private bool $can_drive;
    private ?string $means_of_locomotion;
    private ?string $interests;
    private ?string $why;
    private ?string $housing;
    private ?string $housing_2_availabilities;
    private ?string $housing_3_budget;
    private ?string $preferences;
   /*
   private ?string $marital_status;
    private bool $is_house;
    private bool $is_landlord;
    private bool $have_animal;
    private ?string $animal;
    private ?string $public_transport_distance;
    private ?string $needs;
    private ?string $passion_to_share;
    private bool $can_stay_summer;
    private ?string $profession;
    private ?string $advantages_with_you;
    private bool $has_kids;
    private bool $has_grandkids;
    private bool $is_family_present;
    private ?string $is_family_ok;
    private ?string $room_surface;
    private bool $has_furniture;
    private bool $can_clean;
    private bool $has_internet;
   */


// Méthodes Getter
    public function getEmail(): ?string {
        return $this->email;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function getLast_Name(): ?string {
        return $this->last_name;
    }

    public function getFirst_Name(): ?string {
        return $this->first_name;
    }
    public function getDate_Of_Birth(): ?string {
        return $this->date_of_birth;
    }

    public function getNationality(): ?string {
        return $this->nationality;
    }

    public function getPhone(): ?string {
        return $this->phone;
    }

    public function getParents_Adress(): ?string {
        return $this->parents_adress;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function getPostalCode(): ?string {
        return $this->postal_code;
    }

    public function getKnow_Association(): ?string {
        return $this->know_association;
    }

    public function getEducation_Level(): ?string {
        return $this->education_level;
    }
    public function getInternships(): ?string {
        return $this->interships;
    }
    public function getEstablishment(): ?string{
        return $this->establishment;
    }

    public function getEnd_Of_Studies(): ?string {
        return $this->end_of_studies;
    }

    public function getDate_Of_Arrival(): ?string {
        return $this->date_of_arrival;
    }

    public function getMotivation(): ?string {
        return $this->motivation;
    }

    public function getIs_Smoking(): bool {
        return $this->is_smoking;
    }

    public function getIs_Allergic(): bool {
        return $this->is_allergic;
    }

    public function getAllergies(): ?string {
        return $this->allergies;
    }

    public function getCan_Drive(): ?bool {
        return $this->can_drive;
    }

    public function getMeans_Of_Locomotion(): ?string {
        return $this->means_of_locomotion;
    }

    public function getInterests(): ?string {
        return $this->interests;
    }

    public function getWhy(): ?string {
        return $this->why;
    }

    public function getHousing(): ?string {
        return $this->housing;
    }

    public function getHousing_2_Availabilities(): ?string{
        return $this->housing_2_availabilities;
    }
    public function getHousing_3_Budget(): ?string{
        return $this->housing_3_budget;
    }
    public function getPreferences(): ?string {
        return $this->preferences;
    }

    /*
     *  public function getMaritalStatus(): ?string {
        return $this->marital_status;
    }

    public function getIsHouse(): bool {
        return $this->is_house;
    }

    public function getIsLandlord(): bool {
        return $this->is_landlord;
    }

    public function getHaveAnimal(): bool {
        return $this->have_animal;
    }

    public function getAnimal(): ?string {
        return $this->animal;
    }

    public function getPublicTransportDistance(): ?string {
        return $this->public_transport_distance;
    }

    public function getNeeds(): ?string {
        return $this->needs;
    }

    public function getPassionToShare(): ?string {
        return $this->passion_to_share;
    }

    public function getCanStaySummer(): bool {
        return $this->can_stay_summer;
    }

    public function getProfession(): ?string {
        return $this->profession;
    }

    public function getAdvantagesWithYou(): ?string {
        return $this->advantages_with_you;
    }

    public function getHasKids(): bool {
        return $this->has_kids;
    }

    public function getHasGrandkids(): bool {
        return $this->has_grandkids;
    }

    public function getIsFamilyPresent(): bool {
        return $this->is_family_present;
    }

    public function getIsFamilyOk(): ?string {
        return $this->is_family_ok;
    }

    public function getRoomSurface(): ?string {
        return $this->room_surface;
    }

    public function getHasFurniture(): bool {
        return $this->has_furniture;
    }

    public function getCanClean(): bool {
        return $this->can_clean;
    }

    public function getHasInternet(): bool {
        return $this->has_internet;
    }

     */

    // Méthodes Setter

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function setLast_Name(?string $last_name): void {
        $this->last_name = $last_name;
    }

    public function setFirst_Name(?string $first_name): void {
        $this->first_name = $first_name;
    }
    public function setDate_Of_Birth(?string $date_of_birth): void {
        $this->date_of_birth = $date_of_birth;
    }

    public function setNationality(?string $nationality):void {
        $this->nationality = $nationality;
    }
    public function setPhone(?string $phone): void {
        $this->phone = $phone;
    }

    public function setParents_Adress(?string $parents_adress): void {
        $this->parents_adress = $parents_adress;
    }

    public function setCity(?string $city): void {
        $this->city = $city;
    }

    public function setPostalCode(?string $postal_code): void {
        $this->postal_code = $postal_code;
    }

    public function setKnow_Association(?string $know_association): void {
        $this->know_association = $know_association;
    }

    public function setEducation_Level(?string $education_level): void {
        $this->education_level = $education_level;
    }
    public function setInterships(?string $interships): void{
        $this->interships = $interships;
    }
    public function setEstablishment(?string $establishment): void{
        $this->establishment = $establishment;
    }

    public function setEnd_Of_Studies(?string $end_of_studies): void {
        $this->end_of_studies = $end_of_studies;
    }

    public function setDate_Of_Arrival(?string $date_of_arrival): void {
        $this->date_of_arrival= $date_of_arrival;
    }

    public function setMotivation(?string $motivation): void {
        $this->motivation = $motivation;
    }

    public function setIs_Smoking(bool $is_smoking): void {
        $this->is_smoking = $is_smoking;
    }

    public function setIs_Allergic(bool $is_allergic): void {
        $this->is_allergic = $is_allergic;
    }

    public function setAllergies(?string $allergies): void {
        $this->allergies = $allergies;
    }

    public function setCan_Drive(bool $can_drive): void {
        $this->can_drive = $can_drive;
    }

    public function setMeans_Of_Locomotion(?string $means_of_locomotion): void {
        $this->means_of_locomotion = $means_of_locomotion;
    }

    public function setInterests(?string $interests): void {
        $this->interests = $interests;
    }

    public function setWhy(?string $why): void {
        $this->why = $why;
    }

    public function setHousing(?string $housing ): void {
        $this->housing = $housing;
    }

    public function setHousing_2_Availabilities(?string $availability): void{
        $this->housing_2_availabilities = $availability;
    }

    public function setHousing_3_Budget(?string $budget):void {
        $this->housing_3_budget = $budget;
    }
    public function setPreferences(?string $preferencesQuartier): void {
        $this->preferences = $preferencesQuartier;
    }
    /*
     * public function setMaritalStatus(?string $marital_status): void {
        $this->marital_status = $marital_status;
    }

    public function setIsHouse(bool $is_house): void {
        $this->is_house = $is_house;
    }

    public function setIsLandlord(bool $is_landlord): void {
        $this->is_landlord = $is_landlord;
    }

    public function setHaveAnimal(bool $have_animal): void {
        $this->have_animal = $have_animal;
    }

    public function setAnimal(?string $animal): void {
        $this->animal = $animal;
    }

    public function setPublicTransportDistance(?string $public_transport_distance): void {
        $this->public_transport_distance = $public_transport_distance;
    }

    public function setNeeds(?string $needs): void {
        $this->needs = $needs;
    }

    public function setPassionToShare(?string $passion_to_share): void {
        $this->passion_to_share = $passion_to_share;
    }

    public function setCanStaySummer(bool $can_stay_summer): void {
        $this->can_stay_summer = $can_stay_summer;
    }

    public function setProfession(?string $profession): void {
        $this->profession = $profession;
    }

    public function setAdvantagesWithYou(?string $advantages_with_you): void {
        $this->advantages_with_you = $advantages_with_you;
    }

    public function setHasKids(bool $has_kids): void {
        $this->has_kids = $has_kids;
    }

    public function setHasGrandkids(bool $has_grandkids): void {
        $this->has_grandkids = $has_grandkids;
    }

    public function setIsFamilyPresent(bool $is_family_present): void {
        $this->is_family_present = $is_family_present;
    }

    public function setIsFamilyOk(?string $is_family_ok): void {
        $this->is_family_ok = $is_family_ok;
    }

    public function setRoomSurface(?string $room_surface): void {
        $this->room_surface = $room_surface;
    }

    public function setHasFurniture(bool $has_furniture): void {
        $this->has_furniture = $has_furniture;
    }

    public function setCanClean(bool $can_clean): void {
        $this->can_clean = $can_clean;
    }

    public function setHasInternet(bool $has_internet): void {
        $this->has_internet = $has_internet;
    }
     */
}