using UnityEngine;
using System.Collections;
using UnityEngine.UI;
using Parse;

public class OptionsController : MonoBehaviour
{
	public OptionItem[] options;
	public Button nextButton;
	public SentencesController senController;

	public int selectedOption;
	// Use this for initialization
	void Start ()
	{
		nextButton.gameObject.SetActive (false);
	}

	public void selectOption(int index){
		nextButton.gameObject.SetActive (true);
		selectedOption = index;
		for (int i = 0; i < options.Length; i++) {
			if (i == index) {
				options [i].select ();
				senController.updateSentence (options[i].value);
			}
			else
				options [i].deselect ();
		}
	}

	public void resetSelectedOption(){
		nextButton.gameObject.SetActive (false);
		options [selectedOption].deselect ();
	}

	public void showAvailableOptions(ParseObject sentence){
		if ((bool)sentence ["afraid"]) {
			options [0].gameObject.SetActive (true);
		} else {
			options [0].gameObject.SetActive (false);
		}

		if ((bool)sentence ["happy"]) {
			options [1].gameObject.SetActive (true);
		} else {
			options [1].gameObject.SetActive (false);
		}

		if ((bool)sentence ["angry"]) {
			options [2].gameObject.SetActive (true);
		} else {
			options [2].gameObject.SetActive (false);
		}

		if ((bool)sentence ["disgusted"]) {
			options [3].gameObject.SetActive (true);
		} else {
			options [3].gameObject.SetActive (false);
		}

		if ((bool)sentence ["sad"]) {
			options [4].gameObject.SetActive (true);
		} else {
			options [4].gameObject.SetActive (false);
		}

	}

}

