using UnityEngine;
using System.Collections;
using UnityEngine.SceneManagement;

public class Splash : MonoBehaviour
{
	public float preDelay;
	public float postDelay;
	public string lvlToLoad;
	public GameObject canvas;

	// Use this for initialization
	void Start ()
	{
		canvas.SetActive (false);
		StartCoroutine (showCanvas ());
	}

	IEnumerator showCanvas(){

		yield return new WaitForSeconds (preDelay);
		canvas.SetActive (true);
		StartCoroutine (loadGame ());
	}

	IEnumerator loadGame(){

		yield return new WaitForSeconds (postDelay);
		SceneManager.LoadScene (lvlToLoad);

	}
}

